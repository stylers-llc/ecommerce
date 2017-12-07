<?php

namespace Stylers\Ecommerce\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PayerInfo;
use PayPal\Api\Address;
use PayPal\Api\ShippingAddress;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Api\Transaction as PayPalTransaction;

class PayPal
{
    private $_basket;
    private $_apiContext;
    private $_payer;

    public function __construct(Basket $basket)
    {
        $this->_apiContext = new ApiContext(new OAuthTokenCredential(Config::get('ecommerce.paypal.client_id'), Config::get('ecommerce.paypal.secret')));
        $this->_apiContext->setConfig(Config::get('ecommerce.paypal.settings'));
        $this->_basket = $basket;
        $this->_payer = new Payer();
    }

    public function createPayment()
    {
        $this->_payer->setPayerInfo($this->getPayerInfo());
        $this->_payer->setPaymentMethod(Config::get('ecommerce.paypal.payment_method.paypal'));

        $products = $this->_basket->basketProducts();


        $itemList = new ItemList();
        foreach ($products as $product) {

            $tmpItem = new Item();
            $tmpItem->setName($product->product->name->description)
                ->setCurrency($this->_basket->currency)
                ->setQuantity($product->qty)
                ->setPrice($product->price)
                ->setSku(str_slug($product->product->name->description, "_"));
            $itemList->addItem($tmpItem);
        }

        # @ivan hihetetlen, de itt kell szerepeltetni ahhoz, hogy megjelenjen
        # a PayPal-on a webshopban megadott kiszallitasi cim!
        $itemList->setShippingAddress($this->getShippingAddress());

        $details = new Details();
        $details->setShipping($this->_basket->shipping_fee)
            ->setTax(($this->_basket->sub_total_gross - $this->_basket->sub_total))
            ->setSubtotal($this->_basket->sub_total);

        $amount = new Amount();
        $amount->setCurrency($this->_basket->currency)
            ->setTotal($this->_basket->total)
            ->setDetails($details);

        $date = new \DateTime();
        $transaction = new PayPalTransaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            //->setDescription("Payment description")
            ->setInvoiceNumber($this->_basket->id."#".$date->getTimestamp());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('ecommerce/paymentStatus'))
            ->setCancelUrl(url('ecommerce/paymentStatus'));

        $payment = new Payment();
        $payment->setIntent(Config::get('ecommerce.paypal.payment_intent.sale'))
            ->setPayer($this->_payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_apiContext);
        } catch (PayPalConnectionException $ex) {
            if(config('app.debug')) {
                throw new \Exception("PayPal error: Connection timeout");
            } else {
                throw new \Exception("PayPal error: Some error occur, sorry for inconvenient");
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        $transaction = new Transaction();
        $transaction->pay_status_tx_id = Config::get('ecommerce.transaction_pay_statuses.created');
        $transaction->payment_id = $payment->getId();
        $transaction->basket_id = $this->_basket->id;
        $transaction->save();

        if(isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        throw new \Exception("PayPal error: Connection timeout");
    }

    public function processPaymentStatus($paymentId, $payerID, $token) : bool
    {
        $payment = Payment::get($paymentId, $this->_apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerID);
        $result = $payment->execute($execution, $this->_apiContext);

        if ($result->getState() == Config::get('ecommerce.paypal.payment_state.approved')) {
            $transaction = Transaction::where('payment_id', $paymentId)->firstOrFail();
            $transaction->pay_status_tx_id = Config::get('ecommerce.transaction_pay_statuses.paid');
            $transaction->save();
            $this->_basket->basket_status_tx_id = Config::get('ecommerce.basket_statuses.paid');
            return $this->_basket->save();
        } else {
            $transaction = Transaction::where('payment_id', $paymentId)->firstOrFail();
            $transaction->pay_status_tx_id = Config::get('ecommerce.transaction_pay_statuses.canceled');
            $transaction->save();
            return false;
        }
    }

    /**
     * Get shipping details by basket's data
     */
    protected function getShippingAddress() : ShippingAddress
    {
        $address = $this->_basket->deliveryAddress()->first();

        $shippingAddress = new ShippingAddress();

        $shippingAddress->setRecipientName($address->name);
        if ($address->phone)
        {
            $shippingAddress->setPhone($address->phone);
        }
        $shippingAddress->setState($address->state);
        $shippingAddress->setCountryCode($address->country);
        $shippingAddress->setPostalCode($address->postal_code);
        $shippingAddress->setCity($address->city);
        $shippingAddress->setLine1($address->address_line);
        $shippingAddress->setLine2($address->address_line2);

        return $shippingAddress;
    }

    /**
     * Get billing information
     */
    protected function getBillingAddress() : Address
    {
        $address = $this->_basket->billingAddress()->first();

        $billingAddress = new Address();

        if ($address->phone)
        {
            $billingAddress->setPhone($address->phone);
        }
        $billingAddress->setState($address->state);
        $billingAddress->setCountryCode($address->country);
        $billingAddress->setPostalCode($address->postal_code);
        $billingAddress->setCity($address->city);
        $billingAddress->setLine1($address->address_line);
        $billingAddress->setLine2($address->address_line2);

        return $billingAddress;
    }

    /**
     * Get payer info
     */
    protected function getPayerInfo() : PayerInfo
    {
        $payerInfo = new PayerInfo();
        //$payerInfo->setEmail('david.nasztanovics-buyer@stylersonline.com');
        $payerInfo->setEmail($this->_basket->user->email);

        # @ivan nem a legszebb megoldas, de mivel egyben van tarolva a nev nem latok mas opciot
        $name = $this->splitName();

        $payerInfo->setFirstName($name['firstName']);
        $payerInfo->setLastName($name['lastName']);

        $payerInfo->setBillingAddress($this->getBillingAddress());
        $payerInfo->setShippingAddress($this->getShippingAddress());

        return $payerInfo;
    }

    /**
     * Split name to first name and last name
     */
    protected function splitName() : array
    {
        $splitName = explode(' ', $this->_basket->user->name, 2);

        $result = [
            'firstName' => $splitName[0],
            'lastName' => !empty($splitName[1]) ? $splitName[1] : ''
        ];

        return $result;
    }

}
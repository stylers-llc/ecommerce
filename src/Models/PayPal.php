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

    public function __construct(Basket $basket)
    {
        $this->_apiContext = new ApiContext(new OAuthTokenCredential(Config::get('ecommerce.paypal.client_id'), Config::get('ecommerce.paypal.secret')));
        $this->_apiContext->setConfig(Config::get('ecommerce.paypal.settings'));
        $this->_basket = $basket;
    }

    public function createPayment()
    {
        $payer = new Payer();
        $payer->setPaymentMethod(Config::get('ecommerce.paypal.payment_method.paypal'));

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
        /*
        $details = new Details();
        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);
        */

        $amount = new Amount();
        $amount->setCurrency($this->_basket->currency)
            ->setTotal($this->_basket->total);
            //->setDetails($details);

        $transaction = new PayPalTransaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            //->setDescription("Payment description")
            ->setInvoiceNumber($this->_basket->id);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('ecommerce/paymentStatus'))
            ->setCancelUrl(url('ecommerce/paymentStatus'));

        $payment = new Payment();
        $payment->setIntent(Config::get('ecommerce.paypal.payment_intent.sale'))
            ->setPayer($payer)
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
}
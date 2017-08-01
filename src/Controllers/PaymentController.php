<?php

namespace Stylers\Ecommerce\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Stylers\Ecommerce\Models\Basket;
use Stylers\Ecommerce\Models\Cart;
use Stylers\Ecommerce\Models\PayPal;
use Stylers\Ecommerce\Models\Transaction;
use Illuminate\Support\Facades\View;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $cartList = $request->all();
        Cart::update($cartList);
        if(Cart::getProductCount() < 1){
            Redirect::getUrlGenerator('ecommerce/products/list');
        }

        $basket = Basket::createBasket(Cart::get()['cart']);

        return (new PayPal($basket))->createPayment();
    }

    public function paymentStatus(Request $request)
    {
        $requestData = $request->all();
        $payment_id = Session::get('paypal_payment_id');
        $transaction = Transaction::where('payment_id', $requestData['paymentId'])
            ->where('pay_status_tx_id', Config::get('ecommerce.transaction_pay_statuses.created'))
            ->firstOrFail();

        Session::forget('paypal_payment_id');

        if(is_null($payment_id) || $payment_id != $requestData['paymentId']) {
            Session::put('error','Payment failed');
            return Redirect::route('ecommerce.cart.list');
        }

        if (empty($requestData['PayerID']) || empty($requestData['token'])) {
            Session::put('error','Payment failed');
            return Redirect::route('ecommerce.cart.list');
        }

        $success = (new PayPal($transaction->basket))
            ->processPaymentStatus($requestData['paymentId'], $requestData['PayerID'], $requestData['token']);

        if($success) {
            Cart::clear();
            Session::put('success','Payment success');
            return Redirect::route('ecommerce.success');
        } else {
            Session::put('error','Payment failed');
            return Redirect::route('ecommerce.cart.list');
        }
    }

    public function success()
    {
        $success = Session::get('success');
        Session::forget('success');
        return View::make('paymentSuccess',['success' => $success]);
    }
}
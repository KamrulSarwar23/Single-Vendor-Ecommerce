<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\CodSetting;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function payment()
    {
        if (!session::has('shipping_address')) {
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }

    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }


    public function storeOrder($paymentMethod, $paymentStatus, $transactionId, $paidAmount, $paidCurrencyName)
    {
        // order
        $setting = GeneralSetting::first();
        $order = new Order();
        $order->invoice_id = rand(1, 999999);
        $order->user_id = Auth::user()->id;
        $order->sub_total =  getTotalCartCount();
        $order->amount = getFinalPayableAmount();
        $order->currency_name = $setting->currency_name;
        $order->currency_icon = $setting->currency_icon;
        $order->product_qty = \Cart::content()->count();
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->order_address = json_encode(Session::get('shipping_address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->coupon = json_encode(Session::get('coupon'));
        $order->order_status = 'pending';
        $order->save();

        // order store
        foreach (\Cart::content() as $item) {
            $product = Product::find($item->id);
            
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->vendor_id = $product->vendor_id;
            $orderProduct->product_name = $product->name;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->variants_total = $item->options->variants_total;
            $orderProduct->unit_price = $item->price;
            $orderProduct->qty = $item->qty;
            $orderProduct->save();

            //update product stock quantity
            $updatedQty = ($product->qty - $item->qty);
            $product->qty = $updatedQty;
            $product->save();
        }

        // store transaction
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->amount = getFinalPayableAmount();
        $transaction->amount_real_currency = $paidAmount;
        $transaction->amount_real_currency_name = $paidCurrencyName;
        $transaction->save();
    }

    public function clearSession()
    {
        \Cart::destroy();
        Session::forget('shipping_address');
        Session::forget('shipping_method');
        Session::forget('coupon');
    }

    // paypal redirect 

    public function paypalConfig()
    {
        $paypalSetting = PaypalSetting::first();
        $config = [
            'mode'    => $paypalSetting->mode == 1 ? 'live' : 'sandbox',
            'sandbox' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => '',
            ],
            'live' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => '',
            ],

            'payment_action' => 'Sale',
            'currency'       => $paypalSetting->currency,
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];

        return $config;
    }

    // paypal redirect 

    public function payWithPaypal()
    {

        $config = $this->paypalConfig();
        $paypalSetting = PaypalSetting::first();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        // calculate payable amount depending on currency rate

        $total = getFinalPayableAmount();
        $payableAmount = round($total * $paypalSetting->currency_rate, 2);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $payableAmount,
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('user.paypal.cancel');
        }
    }


    public function paypalSuccess(Request $request)
    {
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $paypalSetting = PaypalSetting::first();

            // calculate payable amount depending on currency rate
            $total = getFinalPayableAmount();
            $paidAmount = round($total * $paypalSetting->currency_rate, 2);
            $this->storeOrder('paypal', 1, $response['id'],  $paidAmount, $paypalSetting->currency);

            // clear all the session item
            $this->clearSession();
            toastr('Payment Success');
            return redirect()->route('user.payment.success');
        }
        return redirect()->route('user.paypal.cancel');
    }
    public function paypalCancel()
    {
        toastr('Something went wrong try later!', 'error', 'Error');
        return redirect()->route('user.payment');
    }

    // stripe Payment
    public function payWithStripe(Request $request)
    {
        // calculate payable amount depending on currency rate
        $stripeSetting = StripeSetting::first();
        $total = getFinalPayableAmount();
        $payableAmount = round($total * $stripeSetting->currency_rate, 2);

        Stripe::setApiKey($stripeSetting->secret_key);
        $response = Charge::create([
            "amount" =>  $payableAmount * 100,
            "currency" => $stripeSetting->currency,
            "source" => $request->stripe_token,
            "description" => "Product Purchase!"
        ]);

        if ($response->status == 'succeeded') {
            $this->storeOrder('stripe', 1, $response->id,  $payableAmount, $stripeSetting->currency);
            // clear all the session item
            $this->clearSession();
            toastr('Payment Success');
            return redirect()->route('user.payment.success');
        } else {

            toastr('Something went wrong try later!', 'error', 'Error');
            return redirect()->route('user.payment');
        }
    }

    public function payWithCod(Request $request){

        $codSetting = CodSetting::first();
        $setting = GeneralSetting::first();
        if($codSetting->status == 0){
            toastr('Cash on Delivery Not Avaiable at this time', 'error', 'Error');
            return redirect()->back();
        }

        $total = getFinalPayableAmount();
        $payableAmount = round($total, 2);

        $this->storeOrder('Cash On Delivery', 0, \Str::random(10), $payableAmount, $setting->currency_name);
        $this->clearSession();
        toastr('Payment Success');
        return redirect()->route('user.payment.success');
    }
}

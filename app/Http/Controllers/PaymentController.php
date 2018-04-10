<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Package;
use App\Models\Travel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cookie;
use Session;
use Log;
use Validator;
use MessageBag;
use Carbon\Carbon;
use Date;
use Uuid;
use File;
use Srmklive\PayPal\Services\ExpressCheckout;
//https://quickadminpanel.com/blog/paypal-payments-in-laravel-the-ultimate-guide/

class PaymentController extends Controller
{
    protected $provider;

    public function __construct() {
        $this->provider = new ExpressCheckout();
    }

    public function expressCheckout(Request $request, $travel_id) {
      // check if payment is recurring
      $recurring = $request->input('recurring', false) ? true : false;
      // get new invoice id
      $invoice_id = Invoice::count() + 1;
      // Get the cart data
      $cart = $this->getCart($recurring, $invoice_id, $travel_id);
      // create new invoice
      $invoice = new Invoice();
      $invoice->title = $cart['invoice_description'];
      $invoice->price = $cart['total'];
      $invoice->travel_id = $travel_id;
      $invoice->save();
      // send a request to paypal
      // paypal should respond with an array of data
      // the array should contain a link to paypal's payment system
      $response = $this->provider->setExpressCheckout($cart, $recurring);
      // if there is no link redirect back with error message
      if (!$response['paypal_link']) {
        Log::error('expressCheckout > paypal_link > error 54');
        return redirect('/travel/create')->withErrors(['Ha ocurrido un error realizando el pago del Recibo #' . $invoice->id, 'codigo'=> 'PAYPALERROR#54']);
        // For the actual error message dump out $response and see what's in there
      }
      // redirect to paypal
      // after payment is done paypal
      // will redirect us back to $this->expressCheckoutSuccess
      return redirect($response['paypal_link']);
    }

    private function getCart($recurring, $invoice_id, $travel_id){
        if ($recurring) {
            return [
                // if payment is recurring cart needs only one item
                // with name, price and quantity
                'items' => [
                    [
                        'name' => 'Suscripción mensual ' . config('paypal.invoice_prefix') . ' #' . $invoice_id,
                        'price' => 25,
                        'qty' => 1,
                    ],
                ],
                // return url is the url where PayPal returns after user confirmed the payment
                'return_url' => url('/paypal/success?recurring=1'),
                'subscription_desc' => 'Plan Mensual ' . config('paypal.invoice_prefix') . ' #' . $invoice_id,
                // every invoice id must be unique, else you'll get an error from paypal
                'invoice_id' => config('paypal.invoice_prefix') . '_' . $invoice_id,
                'invoice_description' => "Plan Mensual #". $invoice_id ." Recibo",
                'cancel_url' => url('/travel/create'),
                // total is calculated by multiplying price with quantity of all cart items and then adding them up
                // in this case total is 20 because price is 20 and quantity is 1
                'total' => 25, // Total price of the cart
            ];
        }
        return [
            // if payment is not recurring cart can have many items
            // with name, price and quantity
            'items' => [
                [
                    'name' => 'Paqueto Viajero',
                    'price' => 4,
                    'qty' => 1,
                ],
                [
                    'name' => 'Verificación de Seguridad',
                    'price' => 1,
                    'qty' => 1,
                ],
            ],
            // return url is the url where PayPal returns after user confirmed the payment
            'return_url' => url('/paypal/success/'.$travel_id),
            // every invoice id must be unique, else you'll get an error from paypal
            'invoice_id' => config('paypal.invoice_prefix') . '_' . $invoice_id,
            'invoice_description' => "Paqueto viajero #" . $travel_id . '-' . $invoice_id . " Recibo",
            'cancel_url' => url('/travel/create'),
            // total is calculated by multiplying price with quantity of all cart items and then adding them up
            // in this case total is 20 because Product 1 costs 10 (price 10 * quantity 1) and Product 2 costs 10 (price 5 * quantity 2)
            'total' => 5,
        ];
    }

    public function expressCheckoutSuccess(Request $request, $travel_id) {
        // check if payment is recurring
        $recurring = $request->input('recurring', false) ? true : false;
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
        $invoice_id = $request->input('invoice_id');
        //$travel_id = $request->input('travel_id');
        // initaly we paypal redirects us back with a token
        // but doesn't provice us any additional data
        // so we use getExpressCheckoutDetails($token)
        // to get the payment details
        $response = $this->provider->getExpressCheckoutDetails($token);
        // if response ACK value is not SUCCESS or SUCCESSWITHWARNING
        // we return back with error
        if (!in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            Log::error('expressCheckoutSuccess > ack > processing > 128');
            return redirect('/travel/create')->withErrors(['Ha ocurrido un error realizando el pago, por favor, contactanos a soporte@paqueto.com.ve', 'codigo'=> 'PAYPALERROR#129']);
        }
        // invoice id is stored in INVNUM
        // because we set our invoice to be xxxx_id
        // we need to explode the string and get the second element of array
        // witch will be the id of the invoice
        $invoice_id = explode('_', $response['INVNUM'])[1];
        // get cart data
        $cart = $this->getCart($recurring, $invoice_id, $travel_id);
        // check if our payment is recurring
        if ($recurring === true) {
            // if recurring then we need to create the subscription
            // you can create monthly or yearly subscriptions
            $response = $this->provider->createMonthlySubscription($response['TOKEN'], $response['AMT'], $cart['subscription_desc']);
            $status = 'Invalid';
            // if after creating the subscription paypal responds with activeprofile or pendingprofile
            // we are good to go and we can set the status to Processed, else status stays Invalid
            if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                $status = 'Processed';
            }
        } else {
            // if payment is not recurring just perform transaction on PayPal
            // and get the payment status
            $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
        } 
        //Log::debug('159 : $payment_status: '. json_encode($status));
        // find invoice by id
        $factura = Invoice::select('id')->where('travel_id','=',$travel_id)->first();
        $invoice = Invoice::find($factura->id);
        Log::debug('162 : $invoices: '.$factura->id.' > '. json_encode($invoice));
        // set invoice status
        $invoice->payment_status = $status;
        // if payment is recurring lets set a recurring id for latter use
        if ($recurring === true) {
            $invoice->recurring_id = $response['PROFILEID'];
        }
        // save the invoice
        $invoice->save();
        // App\Invoice has a paid attribute that returns true or false based on payment status
        // so if paid is false return with error, else return with success message
        if ($invoice->paid) {
            $travel = Travel::find($invoice->travel_id);
            $travel->status = 1; // Activo el viaje!
            $travel->save();
            return redirect('/user/travel/'.Auth::user()->id)->with(['status' => 'Has publicado un viaje!']);
        }
        Log::error('expressCheckoutSuccess > error > processing > 170');
        return redirect('/travel/create')->withErrors(['Ha ocurrido un error realizando el pago del Recibo #' . $invoice->id, 'codigo'=> 'PAYPALERROR#171']);
    }

    public function notify(Request $request){
        // add _notify-validate cmd to request,
        // we need that to validate with PayPal that it was realy
        // PayPal who sent the request
        $request->merge(['cmd' => '_notify-validate']);
        $post = $request->all();
        // send the data to PayPal for validation
        $response = (string) $this->provider->verifyIPN($post);
        //if PayPal responds with VERIFIED we are good to go
        if ($response === 'VERIFIED') {
            /*
                This is the part of the code where you can process recurring payments as you like
                in this case we will be checking for recurring_payment that was completed
                if we find that data we create new invoice
            */
            if ($post['txn_type'] == 'recurring_payment' && $post['payment_status'] == 'Completed') {
                $invoice = new Invoice();
                $invoice->title = 'Recurring payment';
                $invoice->price = $post['amount'];
                $invoice->payment_status = 'Completed';
                $invoice->recurring_id = $post['recurring_payment_id'];
                $invoice->save();
            }
            // I leave this code here so you can log IPN data if you want
            // PayPal provides a lot of IPN data that you should save in real world scenarios
            $logFile = 'ipn_log_'.Carbon::now()->format('Ymd_His').'.txt';
                Storage::disk('local')->put($logFile, print_r($post, true));
        }
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Package;
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
use PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{

    // protected $provider;

    public function __construct()
    {
        // $this->provider = new ExpressCheckout();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['titulo'] = "Mis Envios";
        $data['results'] = Package::paginate(16);
        $response = [];
        if (session()->has('code')) {
            $response['code'] = session()->get('code');
            session()->forget('code');
        }

        if (session()->has('message')) {
            $response['message'] = session()->get('message');
            session()->forget('message');
        }
        return view('pages.pay', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
 * @param \Illuminate\Http\Request $request
 *
 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
 */
public function getExpressCheckout(Request $request)
{
    $recurring = ($request->get('mode') === 'recurring') ? true : false;
    $cart = $this->getCheckoutData($recurring);

    try {
        $response = $this->provider->setExpressCheckout($cart, $recurring);

        return redirect($response['paypal_link']);
    } catch (\Exception $e) {
        $invoice = $this->createInvoice($cart, 'Invalid');

        session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
    }
}

/**
 * Process payment on PayPal.
 *
 * @param \Illuminate\Http\Request $request
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function getExpressCheckoutSuccess(Request $request)
{
    $recurring = ($request->get('mode') === 'recurring') ? true : false;
    $token = $request->get('token');
    $PayerID = $request->get('PayerID');

    $cart = $this->getCheckoutData($recurring);

    // Verify Express Checkout Token
    $response = $this->provider->getExpressCheckoutDetails($token);

    if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
        if ($recurring === true) {
            $response = $this->provider->createMonthlySubscription($response['TOKEN'], 9.99, $cart['subscription_desc']);
            if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                $status = 'Processed';
            } else {
                $status = 'Invalid';
            }
        } else {
            // Perform transaction on PayPal
            $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
        }

        $invoice = $this->createInvoice($cart, $status);

        if ($invoice->paid) {
            session()->put(['code' => 'success', 'message' => "Order $invoice->id has been paid successfully!"]);
        } else {
            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
        }

        return redirect('/');
    }
}
/**
     * Parse PayPal IPN.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function notify(Request $request)
    {
        if (!($this->provider instanceof ExpressCheckout)) {
            $this->provider = new ExpressCheckout();
        }

        $request->merge(['cmd' => '_notify-validate']);
        $post = $request->all();

        $response = (string) $this->provider->verifyIPN($post);

        $logFile = 'ipn_log_'.Carbon::now()->format('Ymd_His').'.txt';
        Storage::disk('local')->put($logFile, $response);
    }

    /**
     * Set cart data for processing payment on PayPal.
     *
     * @param bool $recurring
     *
     * @return array
     */
    protected function getCheckoutData($recurring = false)
    {
        $data = [];

        $order_id = Invoice::all()->count() + 1;

        if ($recurring === true) {
            $data['items'] = [
                [
                    'name'  => 'Monthly Subscription '.config('paypal.invoice_prefix').' #'.$order_id,
                    'price' => 0,
                    'qty'   => 1,
                ],
            ];

            $data['return_url'] = url('/paypal/ec-checkout-success?mode=recurring');
            $data['subscription_desc'] = 'Monthly Subscription '.config('paypal.invoice_prefix').' #'.$order_id;
        } else {
            $data['items'] = [
                [
                    'name'  => 'Product 1',
                    'price' => 9.99,
                    'qty'   => 1,
                ],
                [
                    'name'  => 'Product 2',
                    'price' => 4.99,
                    'qty'   => 2,
                ],
            ];

            $data['return_url'] = url('/paypal/ec-checkout-success');
        }

        $data['invoice_id'] = config('paypal.invoice_prefix').'_'.$order_id;
        $data['invoice_description'] = "Order #$order_id Invoice";
        $data['cancel_url'] = url('/');

        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data['total'] = $total;

        return $data;
    }

    /**
     * Create invoice.
     *
     * @param array  $cart
     * @param string $status
     *
     * @return \App\Invoice
     */
    protected function createInvoice($cart, $status)
    {
        $invoice = new Invoice();
        $invoice->title = $cart['invoice_description'];
        $invoice->price = $cart['total'];
        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
            $invoice->paid = 1;
        } else {
            $invoice->paid = 0;
        }
        $invoice->save();

        collect($cart['items'])->each(function ($product) use ($invoice) {
            $item = new Item();
            $item->invoice_id = $invoice->id;
            $item->item_name = $product['name'];
            $item->item_price = $product['price'];
            $item->item_qty = $product['qty'];

            $item->save();
        });

        return $invoice;
    }
    // End of PayPal

}

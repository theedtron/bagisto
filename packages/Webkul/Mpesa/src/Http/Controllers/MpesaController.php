<?php

namespace Webkul\Mpesa\Http\Controllers;

use Illuminate\Http\Request;
use Webkul\Checkout\Facades\Cart;
use Webkul\Mpesa\Payment\MPesa;
use Webkul\Sales\Repositories\OrderRepository;
use SmoDav\Mpesa\Laravel\Facades\STK;
use Webkul\Sales\Transformers\OrderResource;

class MPesaController extends Controller
{
    /**
     * OrderRepository instance
     */
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Process the payment
     */
    public function process()
    {
        $cart = Cart::getCart();

        $data = (new OrderResource($cart))->jsonSerialize();

        $order = $this->orderRepository->create($data);
        print_r($order);exit;

        $data = request()->all();

        $Mpesa = new MPesa();
        
        return $Mpesa->processPayment($order, $data);
    }

    /**
     * Handle M-Pesa callback
     */
    public function callback(Request $request)
    {
        \Log::info('M-Pesa Callback received:', $request->all());

        $response = $request->all();
        
        if ($response['ResultCode'] == '0') {
            // Payment successful
            $reference = $response['BillRefNumber'];
            $order = $this->orderRepository->findOneByField('increment_id', $reference);

            if ($order) {
                // Update order status
                $order->status = 'processing';
                $order->save();

                // Create invoice
                if ($order->canInvoice()) {
                    $this->invoiceRepository->create($this->prepareInvoiceData($order));
                }
            }
        }

        return response()->json(['ResultCode' => '0', 'ResultDesc' => 'Success']);
    }

    /**
     * Prepare invoice data
     */
    protected function prepareInvoiceData($order)
    {
        $invoiceData = ['order_id' => $order->id];

        foreach ($order->items as $item) {
            $invoiceData['invoice']['items'][$item->id] = $item->qty_to_invoice;
        }

        return $invoiceData;
    }
}
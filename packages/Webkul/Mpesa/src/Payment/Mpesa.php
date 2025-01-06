<?php

namespace Webkul\Mpesa\Payment;

use Webkul\Payment\Payment\Payment;
use SmoDav\Mpesa\Laravel\Facades\STK;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\InvoiceRepository;

class MPesa extends Payment
{
    /**
     * Payment method code
     */
    protected $code = 'mpesa';

    /**
     * Payment method title
     */
    protected $title = 'M-Pesa';

    /**
     * OrderRepository instance
     */
    protected $orderRepository;

    /**
     * InvoiceRepository instance
     */
    protected $invoiceRepository;

    public function __construct(
        OrderRepository $orderRepository,
        InvoiceRepository $invoiceRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * Get payment method image
     */
    public function getImage()
    {
        return 'mpesa::images/mpesa.png';
    }

    /**
     * Render payment form
     */
    public function getFormPartial()
    {
        return 'mpesa::form';
    }

    /**
     * Additional payment data validation rules.
     */
    public function getValidationRules(): array
    {
        return [
            'mpesa_phone' => 'required|regex:/^254[0-9]{9}$/'
        ];
    }

    /**
     * Get redirect url for processing payment
     */
    public function getRedirectUrl()
    {
        return route('mpesa.process');
    }

    /**
     * Process M-Pesa payment
     */
    public function processPayment($order, $data)
    {
        try {
            $amount = round((float) $order->sub_total + $order->tax_total + ($order->selected_shipping_rate ? $order->selected_shipping_rate->price : 0) - $order->discount_amount, 2);
            $phoneNumber = $data['mpesa_phone'];
            $reference = $order->increment_id;
            
            // Initialize STK Push
            $response = STK::push([
              'amount' => $amount,
              'phoneNumber' => $phoneNumber,
              'reference' => $reference,
              'description' => 'Payment for order #' . $reference
            ]);

            if ($response['ResponseCode'] == '0') {
                // Payment initiated successfully
                return [
                    'success' => true,
                    'checkoutId' => $response['CheckoutRequestID']
                ];
            }

            return [
                'success' => false,
                'message' => $response['ResponseDescription']
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Generate payment form
     */
    public function getFormFields()
    {
        return [
            [
                'name' => 'phone_number',
                'title' => trans('mpesa::app.phone_number'),
                'type' => 'text',
                'validation' => 'required|regex:/^[0-9]{10}$/',
                'depend' => 'payment_method',
                'depend_value' => 'mpesa'
            ]
        ];
    }
}
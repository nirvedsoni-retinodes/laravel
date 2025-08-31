<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class RazorpayService
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(
            config('services.razorpay.key_id'),
            config('services.razorpay.key_secret')
        );
    }

    /**
     * Create a Razorpay order for the booking
     */
    public function createOrder(Booking $booking): array
    {
        try {
            $orderData = [
                'receipt' => $booking->booking_code,
                'amount' => $booking->total_amount * 100, // Convert to paise
                'currency' => 'INR',
                'notes' => [
                    'booking_id' => $booking->id,
                    'facility' => $booking->facility->name,
                    'venue' => $booking->facility->venue->name,
                ],
            ];

            $order = $this->api->order->create($orderData);
            
            // Update booking with order ID
            $booking->update(['razorpay_order_id' => $order['id']]);
            
            return $order;
            
        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'error' => $e->getMessage(),
            ]);
            throw new \Exception('Failed to create payment order: ' . $e->getMessage());
        }
    }

    /**
     * Verify payment signature and update booking
     */
    public function verifyPayment(array $paymentData): Booking
    {
        try {
            $attributes = [
                'razorpay_order_id' => $paymentData['razorpay_order_id'],
                'razorpay_payment_id' => $paymentData['razorpay_payment_id'],
                'razorpay_signature' => $paymentData['razorpay_signature'],
            ];

            // Verify signature
            $this->api->utility->verifyPaymentSignature($attributes);

            // Find and update booking
            $booking = Booking::where('razorpay_order_id', $paymentData['razorpay_order_id'])->firstOrFail();
            
            $booking->update([
                'razorpay_payment_id' => $paymentData['razorpay_payment_id'],
                'payment_status' => 'paid',
                'status' => 'confirmed',
            ]);

            Log::info('Payment verified successfully', [
                'booking_id' => $booking->id,
                'payment_id' => $paymentData['razorpay_payment_id'],
            ]);

            return $booking;
            
        } catch (\Exception $e) {
            Log::error('Payment verification failed: ' . $e->getMessage(), [
                'payment_data' => $paymentData,
                'error' => $e->getMessage(),
            ]);
            throw new \Exception('Payment verification failed: ' . $e->getMessage());
        }
    }

    /**
     * Process webhook from Razorpay
     */
    public function processWebhook(array $webhookData): void
    {
        try {
            $webhookSecret = config('services.razorpay.webhook_secret');
            
            // Verify webhook signature
            $this->api->utility->verifyWebhookSignature(
                json_encode($webhookData),
                $webhookData['razorpay_signature'],
                $webhookSecret
            );

            $paymentId = $webhookData['payload']['payment']['entity']['id'];
            $orderId = $webhookData['payload']['payment']['entity']['order_id'];
            $status = $webhookData['payload']['payment']['entity']['status'];

            $booking = Booking::where('razorpay_order_id', $orderId)->first();
            
            if ($booking) {
                if ($status === 'captured') {
                    $booking->update([
                        'razorpay_payment_id' => $paymentId,
                        'payment_status' => 'paid',
                        'status' => 'confirmed',
                    ]);
                } elseif ($status === 'failed') {
                    $booking->update([
                        'payment_status' => 'failed',
                    ]);
                }
            }

            Log::info('Webhook processed successfully', [
                'payment_id' => $paymentId,
                'order_id' => $orderId,
                'status' => $status,
            ]);
            
        } catch (\Exception $e) {
            Log::error('Webhook processing failed: ' . $e->getMessage(), [
                'webhook_data' => $webhookData,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}

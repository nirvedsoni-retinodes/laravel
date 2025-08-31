<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;
    protected $phoneNumberId;

    public function __construct()
    {
        $this->token = config('services.whatsapp.token');
        $this->phoneNumberId = config('services.whatsapp.phone_number_id');
    }

    /**
     * Send booking confirmation message
     */
    public function sendBookingConfirmation(Booking $booking): bool
    {
        try {
            $message = $this->formatBookingConfirmationMessage($booking);
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
            ])->post("https://graph.facebook.com/v18.0/{$this->phoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $booking->user->phone,
                'type' => 'template',
                'template' => [
                    'name' => 'booking_confirmation',
                    'language' => [
                        'code' => 'en',
                    ],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => $booking->user->name,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $booking->facility->name,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $booking->facility->venue->name,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $booking->formatted_start_time,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $booking->formatted_end_time,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $booking->booking_code,
                                ],
                            ],
                        ],
                    ],
                ],
            ]);

            if ($response->successful()) {
                Log::info('WhatsApp booking confirmation sent', [
                    'booking_id' => $booking->id,
                    'user_phone' => $booking->user->phone,
                ]);
                return true;
            } else {
                Log::error('WhatsApp API error', [
                    'response' => $response->json(),
                    'status' => $response->status(),
                ]);
                return false;
            }
            
        } catch (\Exception $e) {
            Log::error('WhatsApp service error: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Send payment confirmation message
     */
    public function sendPaymentConfirmation(Booking $booking): bool
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
            ])->post("https://graph.facebook.com/v18.0/{$this->phoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $booking->user->phone,
                'type' => 'template',
                'template' => [
                    'name' => 'payment_confirmation',
                    'language' => [
                        'code' => 'en',
                    ],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => $booking->user->name,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $booking->booking_code,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => number_format($booking->total_amount, 2),
                                ],
                            ],
                        ],
                    ],
                ],
            ]);

            if ($response->successful()) {
                Log::info('WhatsApp payment confirmation sent', [
                    'booking_id' => $booking->id,
                    'user_phone' => $booking->user->phone,
                ]);
                return true;
            } else {
                Log::error('WhatsApp API error', [
                    'response' => $response->json(),
                    'status' => $response->status(),
                ]);
                return false;
            }
            
        } catch (\Exception $e) {
            Log::error('WhatsApp service error: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Send status update message
     */
    public function sendStatusUpdate(Booking $booking): bool
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
            ])->post("https://graph.facebook.com/v18.0/{$this->phoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $booking->user->phone,
                'type' => 'template',
                'template' => [
                    'name' => 'status_update',
                    'language' => [
                        'code' => 'en',
                    ],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => $booking->user->name,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $booking->booking_code,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => ucfirst($booking->status),
                                ],
                            ],
                        ],
                    ],
                ],
            ]);

            if ($response->successful()) {
                Log::info('WhatsApp status update sent', [
                    'booking_id' => $booking->id,
                    'user_phone' => $booking->user->phone,
                    'status' => $booking->status,
                ]);
                return true;
            } else {
                Log::error('WhatsApp API error', [
                    'response' => $response->json(),
                    'status' => $response->status(),
                ]);
                return false;
            }
            
        } catch (\Exception $e) {
            Log::error('WhatsApp service error: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Format booking confirmation message
     */
    private function formatBookingConfirmationMessage(Booking $booking): string
    {
        return "Hi {$booking->user->name}! Your booking has been confirmed.\n\n" .
               "Facility: {$booking->facility->name}\n" .
               "Venue: {$booking->facility->venue->name}\n" .
               "Date: {$booking->formatted_start_time}\n" .
               "Time: {$booking->start_time->format('g:i A')} - {$booking->end_time->format('g:i A')}\n" .
               "Booking Code: {$booking->booking_code}\n" .
               "Total Amount: ₹{$booking->total_amount}\n\n" .
               "Thank you for choosing our services!";
    }
}

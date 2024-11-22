<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Resources\Payment;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Log the webhook payload for debugging (optional)
        Log::info('Webhook received: ', $request->all());

        // Verify the source of the webhook
        $data = $request->all();

        // Example: Process the payment
        if (isset($data['type']) && $data['type'] === 'payment') {
            $paymentId = $data['data']['id'];

            // Fetch payment details from MercadoPago API (optional)
            $accessToken = config('app.mp_access_token');
            $client = new PaymentClient();
            $payment = $client->get($paymentId);

            if ($payment->status === 'approved') {
                // Handle the approved payment
                // Example: Mark order as paid in your database
                Log::info("Payment $paymentId approved.");
            }
        }

        // Respond with HTTP 200 to acknowledge receipt
        return response()->json(['status' => 'received'], 200);
    }
}

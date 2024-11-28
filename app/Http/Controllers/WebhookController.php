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
        Log::info('Webhook received', ['rawContent' => $request->getContent()]);
        
        $xSignature = $request->header('X-Signature');
        $xRequestId = $request->header('X-Request-ID');
        $payload = $request->getContent(); // Raw payload of the notification
        $secretKey = config('app.mp_notification_secret'); // Store your webhook secret in your .env file

        $queryParams = $request->query();
        Log::info('query params', ['Query Params' => $queryParams]);

        // Extract "data.id" from query params
        $data = json_decode($payload, true);
        $dataID = $data['id'] ?? '';

        // Split the X-Signature into components
        preg_match('/ts=(\d+),v1=(.+)/', $xSignature, $matches);
        $ts = $matches[1] ?? null;
        $v1 = $matches[2] ?? null;

        // Create the manifest string
        $manifest = "id:$dataID;request-id:$xRequestId;ts:$ts;";

        // Generate the HMAC hash
        $sha = hash_hmac('sha256', $manifest, $secretKey);

        // Verify the HMAC signature
        if ($sha === $v1) {
            // HMAC verification passed
            Log::info("Webhook HMAC verification passed for data ID: $dataID", [$v1, $sha, $manifest, $data]);

            // Handle the webhook data as needed (e.g., process payment)
            return response()->json(['message' => 'Webhook processed successfully'], 200);
        } else {
            // HMAC verification failed
            Log::warning("Webhook HMAC verification failed for data ID: $dataID", [$v1, $sha, $manifest, $data]);

            return response()->json(['error' => 'HMAC verification failed'], 401);
        }
    }
}

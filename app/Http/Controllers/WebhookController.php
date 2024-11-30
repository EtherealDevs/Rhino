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
        Log::channel('webhook')->info('Webhook received', ['all' => json_encode($request->all())]);
        
        $xSignature = $request->header('X-Signature');
        $xRequestId = $request->header('X-Request-ID');
        $payload = $request->getContent(); // Raw payload of the notification
        $secretKey = config('app.mp_notification_secret'); // Store your webhook secret in your .env file

        // Obtain Query params related to the request URL
        $queryParams = $_GET;
        Log::channel('webhook')->info('query params', ['Query Params' => $queryParams]);

        // Extract the "data.id" from the query params
        $dataID = isset($queryParams['data_id']) ? $queryParams['data_id'] : '';
        $data = json_decode($payload, true);

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
            Log::channel('webhook')->info("Webhook verification passed", ['data_id' => $dataID]);

            // Process the webhook data
            $data = json_decode($payload, true);
            if ($dataID) {
                // Example: Save the order to the database
                // $this->processOrder($dataID, $data);
                Log::channel('webhook')->info("Order processed successfully for data ID: $dataID");

                return response()->json(['message' => 'Webhook processed successfully',
                    'received_hash' => $v1,
                    'generated_hash' => $sha,
                    'manifest' => $manifest,
                    'data' => $data
                ], 200);
            } else {
                Log::channel('webhook')->warning("Missing data ID in webhook");
                return response()->json(['error' => 'Missing data ID'], 400);
            }
        } else {
            // HMAC verification failed
            Log::channel('webhook')->warning("Webhook verification failed", [
                'received_hash' => $v1,
                'generated_hash' => $sha,
                'manifest' => $manifest,
                'data' => $data
            ]);

            return response()->json(['error' => 'HMAC verification failed'], 401);
        }
    }
}

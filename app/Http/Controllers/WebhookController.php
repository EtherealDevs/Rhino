<?php

namespace App\Http\Controllers;

use App\Services\WebhookService;
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
            // HMAC verification passed
            Log::channel('webhook')->info("Webhook verification passed", ['data_id' => $dataID]);

            // Send a response to the webhook to confirm the delivery
            response()->json([], 200)->send();
            fastcgi_finish_request();

            // Process the webhook data
            $data = json_decode($payload, true);
                $webhookService = new WebhookService();
                // Example: Save the order to the database
                $order = $webhookService->handleWebhookOrders($data->id, $data);
                Log::channel('webhook')->info("Order processed successfully for data ID: $dataID");

                return redirect()->route('orders.show', ['id' => $order->id]);
        } else {
            // HMAC verification failed
            Log::channel('webhook')->warning("Webhook verification failed", [
                'received_hash' => $v1,
                'generated_hash' => $sha,
                'manifest' => $manifest,
                'data' => $data
            ]);

            return response()->json(['error' => 'HMAC verification failed'], 401)->send();
        }
    }
}

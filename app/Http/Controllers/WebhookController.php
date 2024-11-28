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

        // Split the X-Signature into components
        preg_match('/ts=(\d+),v1=(.+)/', $xSignature, $matches);
        $ts = $matches[1] ?? null;
        $v1 = $matches[2] ?? null;

        // Construct the template
        $data = json_decode($payload, true);
        $template = sprintf('id:%s;request-id:%s;ts:%s;', $data['id'] ?? '', $xRequestId, $ts);

        // Generate HMAC signature
        $computedSignature = hash_hmac('sha256', $template, $secretKey);

        // Compare the computed signature with the one from the header
        if (!hash_equals($computedSignature, $v1)) {
            abort(403, 'Signature mismatch');
        }

        // If the verification passes, process the webhook data
        $data = $request->all();
        Log::info('Webhook verified and processed: ', $data);

        return response()->json(['status' => 'verified'], 200);
    }
}

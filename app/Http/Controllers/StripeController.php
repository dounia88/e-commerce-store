<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Webhook;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createPaymentIntent(Request $request)
    {
        try {
            $cartItems = auth()->user()->cartItems()->with('product')->get();
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            $paymentIntent = PaymentIntent::create([
                'amount' => $total * 100, // Convert to cents
                'currency' => 'eur',
                'metadata' => [
                    'user_id' => auth()->id()
                ]
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            Log::error('Invalid payload: ' . $e->getMessage());
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Invalid signature: ' . $e->getMessage());
            return response('Invalid signature', 400);
        }

        // Handle the event
        switch ($event['type']) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event['data']['object'];
                $this->handleSuccessfulPayment($paymentIntent);
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event['data']['object'];
                $this->handleFailedPayment($paymentIntent);
                break;
            default:
                Log::info('Received unknown event type: ' . $event['type']);
        }

        return response('Success', 200);
    }

    private function handleSuccessfulPayment($paymentIntent)
    {
        $userId = $paymentIntent['metadata']['user_id'] ?? null;

        if ($userId) {
            // Find the order and update its status
            $order = Order::where('user_id', $userId)
                         ->where('stripe_payment_intent_id', $paymentIntent['id'])
                         ->first();

            if ($order) {
                $order->update(['status' => 'completed']);
                Log::info('Order ' . $order->id . ' marked as completed');
            }
        }
    }

    private function handleFailedPayment($paymentIntent)
    {
        $userId = $paymentIntent['metadata']['user_id'] ?? null;

        if ($userId) {
            // Find the order and update its status
            $order = Order::where('user_id', $userId)
                         ->where('stripe_payment_intent_id', $paymentIntent['id'])
                         ->first();

            if ($order) {
                $order->update(['status' => 'failed']);
                Log::info('Order ' . $order->id . ' marked as failed');
            }
        }
    }
}

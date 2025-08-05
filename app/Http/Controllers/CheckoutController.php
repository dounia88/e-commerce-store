<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide !');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|array',
            'billing_address' => 'required|array',
            'payment_method_id' => 'required|string'
        ]);

        $cartItems = Auth::user()->cartItems()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide !');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'order_number' => 'ORD-' . time() . '-' . Auth::id(),
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address,
                'notes' => $request->notes
            ]);

            // Create order products
            foreach ($cartItems as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);

                // Update product stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart
            Auth::user()->cartItems()->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)
                           ->with('success', 'Commande passée avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erreur lors du traitement de la commande.');
        }
    }

    public function createPaymentIntent(Request $request)
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $paymentIntent = PaymentIntent::create([
                'amount' => $total * 100, // Convert to cents
                'currency' => 'usd',
                'metadata' => [
                    'user_id' => Auth::id()
                ]
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

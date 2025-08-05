<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $vendor = Auth::user();

        // Récupérer les commandes qui contiennent des produits du vendeur
        $orders = Order::whereHas('products', function($query) use ($vendor) {
            $query->where('user_id', $vendor->id);
        })->with(['user', 'products' => function($query) use ($vendor) {
            $query->where('user_id', $vendor->id);
        }])->latest()->paginate(10);

        return view('vendor.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $vendor = Auth::user();

        // Vérifier que la commande contient des produits du vendeur
        $hasVendorProducts = $order->products()->where('user_id', $vendor->id)->exists();

        if (!$hasVendorProducts) {
            abort(403, 'Accès refusé.');
        }

        // Charger seulement les produits du vendeur pour cette commande
        $order->load(['user', 'products' => function($query) use ($vendor) {
            $query->where('user_id', $vendor->id);
        }]);

        return view('vendor.orders.show', compact('order'));
    }
}

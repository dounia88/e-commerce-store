<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $client = auth()->user();

        // Statistiques du client
        $totalOrders = $client->orders()->count();
        $pendingOrders = $client->orders()->where('status', 'pending')->count();
        $completedOrders = $client->orders()->where('status', 'completed')->count();
        $totalSpent = $client->orders()->where('status', 'completed')->sum('total_price');

        // Commandes récentes
        $recentOrders = $client->orders()->latest()->take(5)->get();

        // Articles dans le panier
        $cartItemsCount = $client->cartItems()->sum('quantity');

        return view('client.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalSpent',
            'recentOrders',
            'cartItemsCount'
        ));
    }
}

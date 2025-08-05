<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $vendor = auth()->user();

        // Statistiques du vendeur
        $totalProducts = $vendor->products()->count();
        $activeProducts = $vendor->products()->where('is_active', true)->count();
        $totalOrders = Order::whereHas('products', function($query) use ($vendor) {
            $query->where('user_id', $vendor->id);
        })->count();

        $totalRevenue = Order::whereHas('products', function($query) use ($vendor) {
            $query->where('user_id', $vendor->id);
        })->where('status', 'completed')->sum('total_price');

        // Produits récents
        $recentProducts = $vendor->products()->latest()->take(5)->get();

        // Commandes récentes
        $recentOrders = Order::whereHas('products', function($query) use ($vendor) {
            $query->where('user_id', $vendor->id);
        })->latest()->take(5)->get();

        return view('vendor.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'totalOrders',
            'totalRevenue',
            'recentProducts',
            'recentOrders'
        ));
    }
}

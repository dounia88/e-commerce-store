<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        // Statistiques générales
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCategories = Category::count();

        // Chiffre d'affaires
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        $monthlyRevenue = Order::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->sum('total');

        // Commandes récentes
        $recentOrders = Order::with(['user', 'orderProducts'])
            ->latest()
            ->limit(5)
            ->get();

        // Produits populaires
        $popularProducts = Product::with(['category', 'user'])
            ->orderBy('sales_count', 'desc')
            ->limit(5)
            ->get();

        // Vendeurs actifs
        $topSellers = User::withCount('products')
            ->whereHas('products')
            ->orderBy('products_count', 'desc')
            ->limit(5)
            ->get();

        // Statistiques des commandes par statut
        $orderStats = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Statistiques des ventes par mois (6 derniers mois)
        $monthlySales = Order::where('payment_status', 'paid')
            ->where('created_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(total) as revenue'),
                DB::raw('COUNT(*) as orders')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalCategories',
            'totalRevenue',
            'monthlyRevenue',
            'recentOrders',
            'popularProducts',
            'topSellers',
            'orderStats',
            'monthlySales'
        ));
    }
}

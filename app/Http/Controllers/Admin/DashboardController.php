<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_users' => User::count(),
            'total_revenue' => Order::where('status', '!=', 'cancelled')->sum('total_price'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'low_stock_products' => Product::where('stock', '<', 10)->count()
        ];

        $recent_orders = Order::with('user')->latest()->take(5)->get();
        $top_products = Product::withCount('orders')->orderBy('orders_count', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'top_products'));
    }
}

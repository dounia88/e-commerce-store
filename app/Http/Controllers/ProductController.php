<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search products
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(12);
        $categories = Category::all();
        $featuredProducts = Product::where('is_featured', true)->where('is_active', true)->take(4)->get();

        return view('products.index', compact('products', 'categories', 'featuredProducts'));
    }

    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $product->id)
                                ->where('is_active', true)
                                ->take(4)
                                ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}

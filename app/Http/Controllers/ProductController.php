<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'user'])
            ->active()
            ->inStock();

        // Filtrage par catégorie
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filtrage par prix
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Recherche
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        // Tri
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'popular':
                $query->orderBy('sales_count', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12);
        $categories = Category::active()->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        // Incrémenter le compteur de vues
        $product->increment('views');

        // Produits similaires
        $similarProducts = Product::with(['category', 'user'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->inStock()
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'similarProducts'));
    }

    public function category(Category $category)
    {
        $products = Product::with(['category', 'user'])
            ->where('category_id', $category->id)
            ->active()
            ->inStock()
            ->paginate(12);

        return view('products.category', compact('category', 'products'));
    }

    public function featured()
    {
        $products = Product::with(['category', 'user'])
            ->featured()
            ->active()
            ->inStock()
            ->paginate(12);

        return view('products.featured', compact('products'));
    }

    public function categories()
    {
        $categories = Category::active()->withCount('products')->get();
        return view('categories.index', compact('categories'));
    }
}

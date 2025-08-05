<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
                       ->where('product_id', $product->id)
                       ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    public function update(Request $request, Cart $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cartItem->product->stock
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Quantité mise à jour !');
    }

    public function remove(Cart $cartItem)
    {
        $cartItem->delete();

        return redirect()->back()->with('success', 'Produit retiré du panier !');
    }

    public function clear()
    {
        Auth::user()->cartItems()->delete();

        return redirect()->back()->with('success', 'Panier vidé !');
    }
}

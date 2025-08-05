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
        $cartItems = Auth::user()->carts()->with(['product.category'])->get();
        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        // Vérifier si le produit est déjà dans le panier
        $cartItem = Auth::user()->carts()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Mettre à jour la quantité
            $newQuantity = $cartItem->quantity + $request->quantity;
            
            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Quantité demandée non disponible en stock.');
            }

            $cartItem->update([
                'quantity' => $newQuantity,
                'price' => $product->price,
            ]);
        } else {
            // Ajouter un nouvel article
            Auth::user()->carts()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);
        }

        return back()->with('success', 'Produit ajouté au panier avec succès.');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cart->product->stock,
        ]);

        $cart->update([
            'quantity' => $request->quantity,
            'price' => $cart->product->price,
        ]);

        return back()->with('success', 'Quantité mise à jour avec succès.');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Produit retiré du panier.');
    }

    public function clear()
    {
        Auth::user()->carts()->delete();

        return back()->with('success', 'Panier vidé avec succès.');
    }

    public function getCartCount()
    {
        $count = Auth::user()->carts()->sum('quantity');
        
        return response()->json(['count' => $count]);
    }
}

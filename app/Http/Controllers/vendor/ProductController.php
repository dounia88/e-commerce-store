<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendor = auth()->user();
        $products = $vendor->products()->with('category')->paginate(10);

        return view('vendor.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('vendor.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sku' => 'nullable|string|unique:products,sku',
            'specifications' => 'nullable|array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Create image manager instance
            $manager = new ImageManager(new Driver());
            $processedImage = $manager->read($image);
            $processedImage->resize(800, 600);

            $imagePath = public_path('images/products/' . $imageName);
            $processedImage->save($imagePath);

            $data['image'] = 'images/products/' . $imageName;
        }

        Product::create($data);

        return redirect()->route('vendor.products.index')
                        ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Vérifier que le produit appartient au vendeur connecté
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        return view('vendor.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Vérifier que le produit appartient au vendeur connecté
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        $categories = Category::all();
        return view('vendor.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Vérifier que le produit appartient au vendeur connecté
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'specifications' => 'nullable|array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Create image manager instance
            $manager = new ImageManager(new Driver());
            $processedImage = $manager->read($image);
            $processedImage->resize(800, 600);

            $imagePath = public_path('images/products/' . $imageName);
            $processedImage->save($imagePath);

            $data['image'] = 'images/products/' . $imageName;
        }

        $product->update($data);

        return redirect()->route('vendor.products.index')
                        ->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Vérifier que le produit appartient au vendeur connecté
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        // Delete image
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('vendor.products.index')
                        ->with('success', 'Produit supprimé avec succès.');
    }
}

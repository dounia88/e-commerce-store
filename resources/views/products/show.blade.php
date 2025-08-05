<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('products.index') }}" class="text-green-600 hover:text-green-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-green-800 leading-tight">
                {{ $product->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                    <!-- Product Images -->
                    <div class="space-y-4">
                        <div class="relative">
                            <img src="{{ $product->image ? Storage::url($product->image) : 'https://via.placeholder.com/600x400?text=' . urlencode($product->name) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-96 object-cover rounded-xl">
                            
                            <!-- Favorite Button -->
                            <button class="absolute top-4 right-4 text-pink-500 hover:text-pink-600">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Color Options (Placeholder) -->
                        <div class="flex space-x-2">
                            <div class="w-12 h-12 bg-green-400 rounded-full border-2 border-green-600"></div>
                            <div class="w-12 h-12 bg-gray-400 rounded-full border-2 border-transparent"></div>
                            <div class="w-12 h-12 bg-blue-400 rounded-full border-2 border-transparent"></div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="space-y-6">
                        <div>
                            <h1 class="text-3xl font-bold text-green-800 mb-2">{{ $product->name }}</h1>
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">{{ $product->sku }}</span>
                                <span class="text-sm text-green-600 bg-green-100 px-3 py-1 rounded-full">{{ $product->category->name }}</span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="space-y-2">
                            @if($product->original_price && $product->original_price > $product->price)
                                <div class="flex items-center space-x-3">
                                    <span class="text-3xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                                    <span class="text-xl text-gray-400 line-through">${{ number_format($product->original_price, 2) }}</span>
                                    <span class="text-sm text-red-600 bg-red-100 px-2 py-1 rounded-full">
                                        -{{ $product->discount_percentage }}%
                                    </span>
                                </div>
                            @else
                                <span class="text-3xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>

                        <!-- Description -->
                        <div>
                            <h3 class="text-lg font-semibold text-green-800 mb-2">Description</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <!-- Specifications -->
                        @if($product->specifications)
                            <div>
                                <h3 class="text-lg font-semibold text-green-800 mb-3">Spécifications</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($product->specifications as $key => $value)
                                        <div class="flex justify-between py-2 border-b border-gray-100">
                                            <span class="text-gray-600">{{ $key }}:</span>
                                            <span class="font-medium text-green-800">{{ $value }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Stock Status -->
                        <div class="flex items-center space-x-2">
                            @if($product->stock > 0)
                                <span class="text-green-600 text-sm">✓ En stock ({{ $product->stock }} disponibles)</span>
                            @else
                                <span class="text-red-600 text-sm">✗ Rupture de stock</span>
                            @endif
                        </div>

                        <!-- Add to Cart -->
                        @auth
                            @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div class="flex items-center space-x-4">
                                        <label for="quantity" class="text-sm font-medium text-green-800">Quantité:</label>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                               class="w-20 px-3 py-2 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    </div>
                                    <button type="submit" 
                                            class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                        Ajouter au Panier
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full bg-gray-300 text-gray-500 py-3 rounded-lg font-semibold cursor-not-allowed">
                                    Rupture de Stock
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-green-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                Se connecter pour acheter
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-green-800 mb-6">Produits Similaires</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="relative">
                                    <img src="{{ $relatedProduct->image ? Storage::url($relatedProduct->image) : 'https://via.placeholder.com/300x200?text=' . urlencode($relatedProduct->name) }}" 
                                         alt="{{ $relatedProduct->name }}" 
                                         class="w-full h-48 object-cover rounded-t-xl">
                                    @if($relatedProduct->original_price && $relatedProduct->original_price > $relatedProduct->price)
                                        <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                            -{{ $relatedProduct->discount_percentage }}%
                                        </span>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg text-green-800 mb-2">{{ $relatedProduct->name }}</h3>
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-2">
                                            @if($relatedProduct->original_price && $relatedProduct->original_price > $relatedProduct->price)
                                                <span class="text-gray-400 line-through text-sm">${{ number_format($relatedProduct->original_price, 2) }}</span>
                                            @endif
                                            <span class="text-xl font-bold text-green-600">${{ number_format($relatedProduct->price, 2) }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('products.show', $relatedProduct) }}" 
                                       class="block w-full bg-green-600 text-white text-center py-2 rounded-lg hover:bg-green-700 transition-colors">
                                        Voir Détails
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 
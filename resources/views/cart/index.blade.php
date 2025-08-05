<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Mon Panier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($cartItems->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-sm">
                            <div class="p-6 border-b border-green-100">
                                <h3 class="text-lg font-semibold text-green-800">Produits dans votre panier</h3>
                            </div>
                            
                            <div class="divide-y divide-green-100">
                                @foreach($cartItems as $item)
                                    <div class="p-6">
                                        <div class="flex items-center space-x-4">
                                            <img src="{{ $item->product->image ? Storage::url($item->product->image) : 'https://via.placeholder.com/100x100?text=' . urlencode($item->product->name) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-20 h-20 object-cover rounded-lg">
                                            
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-green-800">{{ $item->product->name }}</h4>
                                                <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                                <div class="flex items-center space-x-2 mt-1">
                                                    @if($item->product->original_price && $item->product->original_price > $item->product->price)
                                                        <span class="text-gray-400 line-through text-sm">${{ number_format($item->product->original_price, 2) }}</span>
                                                    @endif
                                                    <span class="font-semibold text-green-600">${{ number_format($item->product->price, 2) }}</span>
                                                </div>
                                            </div>
                                            
                                            <div class="flex items-center space-x-4">
                                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <label for="quantity-{{ $item->id }}" class="text-sm text-green-800">Qté:</label>
                                                    <input type="number" name="quantity" id="quantity-{{ $item->id }}" 
                                                           value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                                           class="w-16 px-2 py-1 border border-green-200 rounded text-center text-sm">
                                                    <button type="submit" class="text-green-600 hover:text-green-800 text-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4 flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Sous-total: <span class="font-semibold text-green-600">${{ number_format($item->subtotal, 2) }}</span></span>
                                            @if($item->product->stock < $item->quantity)
                                                <span class="text-red-500 text-sm">Stock insuffisant ({{ $item->product->stock }} disponibles)</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="p-6 border-t border-green-100">
                                <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                        Vider le panier
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">
                            <h3 class="text-lg font-semibold text-green-800 mb-4">Résumé de la commande</h3>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Sous-total ({{ $cartItems->sum('quantity') }} articles)</span>
                                    <span class="font-semibold">${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Livraison</span>
                                    <span class="font-semibold text-green-600">Gratuit</span>
                                </div>
                                <div class="border-t border-green-100 pt-3">
                                    <div class="flex justify-between">
                                        <span class="text-lg font-semibold text-green-800">Total</span>
                                        <span class="text-lg font-bold text-green-600">${{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ route('checkout.index') }}" 
                               class="block w-full bg-green-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                Procéder au paiement
                            </a>
                            
                            <div class="mt-4 text-center">
                                <a href="{{ route('products.index') }}" class="text-green-600 hover:text-green-800 text-sm">
                                    Continuer les achats
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Votre panier est vide</h3>
                    <p class="mt-1 text-sm text-gray-500">Commencez par ajouter quelques produits à votre panier.</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            Découvrir nos produits
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 
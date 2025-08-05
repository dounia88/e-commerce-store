<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-green-800 leading-tight">
                {{ __('Nos Lunettes de Soleil') }}
            </h2>
            <div class="text-sm text-green-600">
                {{ $products->total() }} produits trouvés
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-8 mb-8 text-white">
                <div class="max-w-3xl">
                    <h1 class="text-4xl font-bold mb-4">The Future Looks Bright</h1>
                    <p class="text-xl mb-6">Découvrez notre collection exclusive de lunettes de soleil tendance</p>
                    <a href="#products" class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                        Découvrir la Collection
                    </a>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="bg-white rounded-xl p-6 mb-8 shadow-sm">
                <form method="GET" action="{{ route('products.index') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Rechercher vos produits..." 
                               class="w-full px-4 py-3 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    <div class="md:w-48">
                        <select name="category" class="w-full px-4 py-3 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="all">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                        Rechercher
                    </button>
                </form>
            </div>

            <!-- Featured Products -->
            @if($featuredProducts->count() > 0)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-green-800 mb-6">Nouvelles Arrivées</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($featuredProducts as $product)
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <div class="relative">
                                    <img src="{{ $product->image ? Storage::url($product->image) : 'https://via.placeholder.com/300x200?text=' . urlencode($product->name) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-48 object-cover rounded-t-xl">
                                    @if($product->is_featured)
                                        <span class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">Nouveau</span>
                                    @endif
                                    <button class="absolute top-2 right-2 text-pink-500 hover:text-pink-600">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg text-green-800 mb-2">{{ $product->name }}</h3>
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-2">
                                            @if($product->original_price && $product->original_price > $product->price)
                                                <span class="text-gray-400 line-through">${{ number_format($product->original_price, 2) }}</span>
                                            @endif
                                            <span class="text-xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('products.show', $product) }}" 
                                       class="block w-full bg-green-600 text-white text-center py-2 rounded-lg hover:bg-green-700 transition-colors">
                                        Voir Détails
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- All Products -->
            <div id="products">
                <h2 class="text-2xl font-bold text-green-800 mb-6">Tous nos Produits</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                            <div class="relative">
                                <img src="{{ $product->image ? Storage::url($product->image) : 'https://via.placeholder.com/300x200?text=' . urlencode($product->name) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-48 object-cover rounded-t-xl">
                                @if($product->original_price && $product->original_price > $product->price)
                                    <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                        -{{ $product->discount_percentage }}%
                                    </span>
                                @endif
                                <button class="absolute top-2 right-2 text-gray-400 hover:text-pink-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">{{ $product->category->name }}</span>
                                    <span class="text-xs text-gray-500">{{ $product->sku }}</span>
                                </div>
                                <h3 class="font-semibold text-lg text-green-800 mb-2">{{ $product->name }}</h3>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-2">
                                        @if($product->original_price && $product->original_price > $product->price)
                                            <span class="text-gray-400 line-through text-sm">${{ number_format($product->original_price, 2) }}</span>
                                        @endif
                                        <span class="text-xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('products.show', $product) }}" 
                                       class="flex-1 bg-green-600 text-white text-center py-2 rounded-lg hover:bg-green-700 transition-colors">
                                        Voir Détails
                                    </a>
                                    @auth
                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" 
                                                    class="w-full bg-green-100 text-green-600 py-2 rounded-lg hover:bg-green-200 transition-colors">
                                                Ajouter
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
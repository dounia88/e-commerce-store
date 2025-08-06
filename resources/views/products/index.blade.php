@extends('layouts.public')

@section('title', 'Tous les Produits')
@section('description', 'Découvrez tous nos produits sur Luxylia - Votre marketplace de confiance')

@section('content')
<div class="bg-white">
    <!-- En-tête -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Tous nos Produits
                </h1>
                <p class="mt-4 text-xl text-indigo-100">
                    Découvrez notre sélection de produits de qualité
                </p>
                <div class="mt-6">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white bg-opacity-20 text-white">
                        {{ $products->total() }} {{ $products->total() > 1 ? 'produits' : 'produit' }} disponible{{ $products->total() > 1 ? 's' : '' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <form method="GET" action="{{ route('products.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Recherche -->
                    <div class="lg:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   id="search"
                                   value="{{ request('search') }}"
                                   placeholder="Nom du produit, marque..." 
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Catégorie -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                        <select name="category" id="category" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tri -->
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Trier par</label>
                        <select name="sort" id="sort" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récents</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Prix croissant</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Prix décroissant</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nom A-Z</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Populaires</option>
                        </select>
                    </div>
                </div>

                <!-- Filtres prix -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-gray-200">
                    <div>
                        <label for="min_price" class="block text-sm font-medium text-gray-700 mb-1">Prix minimum</label>
                        <input type="number" 
                               name="min_price" 
                               id="min_price"
                               value="{{ request('min_price') }}"
                               placeholder="0"
                               min="0"
                               step="0.01"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="max_price" class="block text-sm font-medium text-gray-700 mb-1">Prix maximum</label>
                        <input type="number" 
                               name="max_price" 
                               id="max_price"
                               value="{{ request('max_price') }}"
                               placeholder="1000"
                               min="0"
                               step="0.01"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200">
                            Filtrer
                        </button>
                    </div>
                </div>

                <!-- Filtres actifs -->
                @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']) && request()->anyFilled(['search', 'category', 'min_price', 'max_price']))
                    <div class="flex flex-wrap items-center gap-2 pt-4 border-t border-gray-200">
                        <span class="text-sm font-medium text-gray-700">Filtres actifs :</span>
                        
                        @if(request('search'))
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                Recherche: "{{ request('search') }}"
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="ml-1 text-indigo-600 hover:text-indigo-800">×</a>
                            </span>
                        @endif
                        
                        @if(request('category'))
                            @php $selectedCategory = $categories->find(request('category')) @endphp
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ $selectedCategory->name ?? 'Catégorie' }}
                                <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="ml-1 text-green-600 hover:text-green-800">×</a>
                            </span>
                        @endif
                        
                        @if(request('min_price') || request('max_price'))
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Prix: {{ request('min_price', '0') }}€ - {{ request('max_price', '∞') }}€
                                <a href="{{ request()->fullUrlWithQuery(['min_price' => null, 'max_price' => null]) }}" class="ml-1 text-yellow-600 hover:text-yellow-800">×</a>
                            </span>
                        @endif
                        
                        <a href="{{ route('products.index') }}" class="text-sm text-gray-500 hover:text-gray-700 underline">
                            Effacer tous les filtres
                        </a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Fil d'Ariane -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Accueil
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Produits</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Grille des produits -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div class="relative aspect-w-1 aspect-h-1 bg-gray-200 overflow-hidden">
                            <img src="{{ $product->main_image_url }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                 loading="lazy">
                            
                            @if($product->hasDiscount())
                                <div class="absolute top-2 left-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        -{{ $product->discount_percentage }}%
                                    </span>
                                </div>
                            @endif
                            
                            @if($product->is_featured)
                                <div class="absolute top-2 right-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Vedette
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-6">
                            <div class="mb-3">
                                <h3 class="font-bold text-lg text-gray-900 group-hover:text-indigo-600 transition-colors duration-300 line-clamp-2">
                                    <a href="{{ route('products.show', $product) }}" class="hover:underline">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $product->category->name ?? 'Sans catégorie' }}</p>
                            </div>
                            
                            @if($product->description)
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                            @endif
                            
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex flex-col">
                                    @if($product->hasDiscount())
                                        <div class="flex items-center space-x-2">
                                            <span class="text-xl font-bold text-red-600">{{ number_format($product->price, 2) }} €</span>
                                            <span class="text-sm text-gray-500 line-through">{{ number_format($product->compare_price, 2) }} €</span>
                                        </div>
                                    @else
                                        <span class="text-xl font-bold text-indigo-600">{{ number_format($product->price, 2) }} €</span>
                                    @endif
                                </div>
                                
                                <div class="text-right">
                                    <div class="text-xs text-gray-500">Stock: {{ $product->stock }}</div>
                                    @if($product->user)
                                        <div class="text-xs text-gray-400">Par {{ $product->user->name }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <a href="{{ route('products.show', $product) }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium flex items-center">
                                    Voir détails
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                
                                @auth
                                    @if($product->isInStock())
                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0h9"></path>
                                                </svg>
                                                Ajouter
                                            </button>
                                        </form>
                                    @else
                                        <span class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                                            Rupture de stock
                                        </span>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                                        Connexion
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit trouvé</h3>
                <p class="mt-1 text-sm text-gray-500">
                    @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                        Essayez de modifier vos critères de recherche.
                    @else
                        Les produits apparaîtront ici une fois ajoutés.
                    @endif
                </p>
                <div class="mt-6">
                    @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Voir tous les produits
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Retour à l'accueil
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

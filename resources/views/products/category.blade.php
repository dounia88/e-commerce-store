@extends('layouts.public')

@section('title', $category->name)
@section('description', $category->description ?? 'Découvrez tous les produits de la catégorie ' . $category->name)

@section('content')
<div class="bg-white">
    <!-- En-tête de la catégorie -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                    {{ $category->name }}
                </h1>
                @if($category->description)
                    <p class="mt-4 text-xl text-indigo-100">
                        {{ $category->description }}
                    </p>
                @endif
                <div class="mt-6">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white bg-opacity-20 text-white">
                        {{ $products->total() }} {{ $products->total() > 1 ? 'produits' : 'produit' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et tri -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-gray-50 rounded-lg p-4 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div class="flex items-center space-x-4">
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-700">Trier par</label>
                        <select id="sort" name="sort" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="newest">Plus récents</option>
                            <option value="price_low">Prix croissant</option>
                            <option value="price_high">Prix décroissant</option>
                            <option value="name">Nom A-Z</option>
                            <option value="popular">Populaires</option>
                        </select>
                    </div>
                    <div>
                        <label for="per_page" class="block text-sm font-medium text-gray-700">Afficher</label>
                        <select id="per_page" name="per_page" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="12">12 par page</option>
                            <option value="24">24 par page</option>
                            <option value="48">48 par page</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher dans cette catégorie..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
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
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('categories.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Catégories</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $category->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Grille des produits -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="group relative bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-t-lg bg-gray-200">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="h-48 w-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300">
                            @else
                                <div class="h-48 w-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            @if($product->is_featured)
                                <div class="absolute top-2 left-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Vedette
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">
                                <a href="{{ route('products.show', $product) }}">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                            
                            <p class="mt-1 text-sm text-gray-500">{{ $product->brand ?? 'Sans marque' }}</p>
                            
                            <div class="mt-2 flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg font-bold text-gray-900">{{ number_format($product->price, 2) }}€</span>
                                    @if($product->original_price && $product->original_price > $product->price)
                                        <span class="text-sm text-gray-500 line-through">{{ number_format($product->original_price, 2) }}€</span>
                                    @endif
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-500">Stock: {{ $product->stock }}</span>
                                </div>
                            </div>
                            
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-xs text-gray-500">Par {{ $product->user->name ?? 'Vendeur' }}</span>
                                @auth
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0h9"></path>
                                            </svg>
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
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit dans cette catégorie</h3>
                <p class="mt-1 text-sm text-gray-500">Les produits de cette catégorie apparaîtront ici une fois ajoutés.</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Voir tous les produits
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
// Gestion du tri et filtrage
document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.getElementById('sort');
    const perPageSelect = document.getElementById('per_page');
    
    function updateUrl() {
        const url = new URL(window.location);
        url.searchParams.set('sort', sortSelect.value);
        url.searchParams.set('per_page', perPageSelect.value);
        window.location.href = url.toString();
    }
    
    sortSelect.addEventListener('change', updateUrl);
    perPageSelect.addEventListener('change', updateUrl);
    
    // Définir les valeurs actuelles
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('sort')) {
        sortSelect.value = urlParams.get('sort');
    }
    if (urlParams.get('per_page')) {
        perPageSelect.value = urlParams.get('per_page');
    }
});
</script>
@endsection

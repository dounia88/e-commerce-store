@extends('layouts.public')

@section('title', 'Catégories')
@section('description', 'Découvrez toutes nos catégories de produits')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                Toutes les catégories
            </h1>
            <p class="mt-4 text-xl text-gray-600">
                Explorez nos différentes catégories de produits
            </p>
        </div>

        @if($categories->count() > 0)
            <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($categories as $category)
                    <div class="group relative bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-t-lg bg-gray-200">
                            @if($category->image)
                                <img src="{{ asset($category->image) }}" 
                                     alt="{{ $category->name }}" 
                                     class="h-48 w-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300">
                            @else
                                <div class="h-48 w-full bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7H5m14 14H5"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">
                                <a href="{{ route('categories.show', $category) }}">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                    {{ $category->name }}
                                </a>
                            </h3>
                            
                            @if($category->description)
                                <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                                    {{ $category->description }}
                                </p>
                            @endif
                            
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    {{ $category->products_count }} {{ $category->products_count > 1 ? 'produits' : 'produit' }}
                                </span>
                                <span class="inline-flex items-center text-sm font-medium text-indigo-600 group-hover:text-indigo-500">
                                    Voir les produits
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7H5m14 14H5"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune catégorie</h3>
                <p class="mt-1 text-sm text-gray-500">Les catégories apparaîtront ici une fois qu'elles seront créées.</p>
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

        <!-- Section CTA -->
        <div class="mt-16 bg-indigo-50 rounded-lg p-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900">Vous ne trouvez pas ce que vous cherchez ?</h2>
                <p class="mt-2 text-gray-600">Utilisez notre recherche pour trouver des produits spécifiques</p>
                <div class="mt-6 max-w-md mx-auto">
                    <form action="{{ route('products.index') }}" method="GET" class="flex">
                        <input type="text" 
                               name="search" 
                               placeholder="Rechercher des produits..." 
                               class="flex-1 min-w-0 px-4 py-2 border border-gray-300 rounded-l-md focus:ring-indigo-500 focus:border-indigo-500">
                        <button type="submit" 
                                class="px-6 py-2 bg-indigo-600 text-white rounded-r-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

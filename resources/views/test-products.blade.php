@extends('layouts.public')

@section('title', 'Test Produits avec Images')
@section('description', 'Page de test pour voir les produits avec leurs images générées automatiquement')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                Test des Produits avec Images
            </h1>
            <p class="mt-4 text-xl text-gray-600">
                Aperçu des produits avec images générées automatiquement basées sur leurs noms
            </p>
        </div>

        <!-- Informations sur le système d'images -->
        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-indigo-900 mb-4">🎨 Système d'Images Automatique</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-indigo-800">
                <div>
                    <h3 class="font-semibold mb-2">📸 Génération d'Images</h3>
                    <ul class="space-y-1">
                        <li>• Images SVG générées automatiquement</li>
                        <li>• Couleurs basées sur le nom du produit</li>
                        <li>• Dégradés uniques pour chaque produit</li>
                        <li>• Fallback intelligent avec placeholders</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-2">⚡ Fonctionnalités</h3>
                    <ul class="space-y-1">
                        <li>• Détection automatique des images existantes</li>
                        <li>• Génération basée sur le slug du produit</li>
                        <li>• Support de plusieurs formats (PNG, JPG, SVG)</li>
                        <li>• Commande Artisan : <code>php artisan products:generate-images</code></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Grille des produits -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
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
                                    {{ $product->name }}
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
                            
                            <!-- Informations sur l'image -->
                            <div class="bg-gray-50 rounded-lg p-3 mb-4">
                                <div class="text-xs text-gray-600">
                                    <div><strong>Image:</strong> {{ $product->main_image ? 'Personnalisée' : 'Générée auto' }}</div>
                                    <div><strong>URL:</strong> <span class="font-mono">{{ basename($product->main_image_url) }}</span></div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <a href="#" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium flex items-center">
                                    Voir détails
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                
                                <button class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0h9"></path>
                                    </svg>
                                    Test
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit trouvé</h3>
                <p class="mt-1 text-sm text-gray-500">Exécutez les seeders pour créer des produits de test.</p>
                <div class="mt-6">
                    <code class="bg-gray-100 px-3 py-1 rounded text-sm">php artisan db:seed --class=ProductSeeder</code>
                </div>
            </div>
        @endif

        <!-- Commandes utiles -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">🛠️ Commandes Utiles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-900 mb-2">Générer les images</h3>
                    <code class="bg-gray-800 text-green-400 px-3 py-1 rounded text-sm block">php artisan products:generate-images</code>
                    <p class="text-xs text-gray-600 mt-2">Génère des images SVG pour tous les produits</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-900 mb-2">Forcer la régénération</h3>
                    <code class="bg-gray-800 text-green-400 px-3 py-1 rounded text-sm block">php artisan products:generate-images --force</code>
                    <p class="text-xs text-gray-600 mt-2">Régénère toutes les images même si elles existent</p>
                </div>
            </div>
        </div>

        <!-- Retour à l'accueil -->
        <div class="text-center mt-8">
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection

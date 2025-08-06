@extends('layouts.public')

@section('title', $product->name)
@section('description', Str::limit($product->description, 160))

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                        <a href="{{ route('products.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Produits</a>
                    </div>
                </li>
                @if($product->category)
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('categories.show', $product->category) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">{{ $product->category->name }}</a>
                        </div>
                    </li>
                @endif
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($product->name, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Contenu principal -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Images du produit -->
            <div class="space-y-4">
                <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                    <img src="{{ $product->main_image_url }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-96 object-cover">
                </div>
                
                @if($product->images && count($product->images) > 1)
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->images as $image)
                            <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-md overflow-hidden cursor-pointer hover:opacity-75">
                                <img src="{{ asset($image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-20 object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Informations du produit -->
            <div class="space-y-6">
                <!-- Titre et badges -->
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        @if($product->is_featured)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                Produit Vedette
                            </span>
                        @endif
                        
                        @if($product->hasDiscount())
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                -{{ $product->discount_percentage }}% de réduction
                            </span>
                        @endif
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                    
                    @if($product->brand)
                        <p class="text-lg text-gray-600">{{ $product->brand }}</p>
                    @endif
                </div>

                <!-- Prix -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex items-center space-x-4">
                        @if($product->hasDiscount())
                            <span class="text-3xl font-bold text-red-600">{{ number_format($product->price, 2) }} €</span>
                            <span class="text-xl text-gray-500 line-through">{{ number_format($product->compare_price, 2) }} €</span>
                        @else
                            <span class="text-3xl font-bold text-indigo-600">{{ number_format($product->price, 2) }} €</span>
                        @endif
                    </div>
                </div>

                <!-- Stock et disponibilité -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex items-center justify-between">
                        <div>
                            @if($product->isInStock())
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    En stock ({{ $product->stock }} disponible{{ $product->stock > 1 ? 's' : '' }})
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    Rupture de stock
                                </span>
                            @endif
                        </div>
                        
                        @if($product->user)
                            <div class="text-sm text-gray-500">
                                Vendu par <span class="font-medium text-gray-900">{{ $product->user->name }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-t border-gray-200 pt-6">
                    @auth
                        @if($product->isInStock())
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="flex items-center space-x-4">
                                    <label for="quantity" class="text-sm font-medium text-gray-700">Quantité :</label>
                                    <select name="quantity" id="quantity" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                        @for($i = 1; $i <= min(10, $product->stock); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                
                                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-8 py-3 rounded-lg text-lg font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9m-9 0h9"></path>
                                    </svg>
                                    Ajouter au panier
                                </button>
                            </form>
                        @else
                            <button disabled class="w-full bg-gray-300 text-gray-500 px-8 py-3 rounded-lg text-lg font-medium cursor-not-allowed">
                                Produit indisponible
                            </button>
                        @endif
                    @else
                        <div class="space-y-4">
                            <p class="text-sm text-gray-600">Connectez-vous pour ajouter ce produit à votre panier</p>
                            <a href="{{ route('login') }}" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-8 py-3 rounded-lg text-lg font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center block">
                                Se connecter
                            </a>
                        </div>
                    @endauth
                </div>

                <!-- Informations supplémentaires -->
                <div class="border-t border-gray-200 pt-6 space-y-4">
                    @if($product->sku)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">SKU :</span>
                            <span class="font-medium text-gray-900">{{ $product->sku }}</span>
                        </div>
                    @endif
                    
                    @if($product->category)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">Catégorie :</span>
                            <a href="{{ route('categories.show', $product->category) }}" class="font-medium text-indigo-600 hover:text-indigo-700">{{ $product->category->name }}</a>
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Vues :</span>
                        <span class="font-medium text-gray-900">{{ number_format($product->views) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        @if($product->description)
            <div class="border-t border-gray-200 pt-8 mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Description</h2>
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>
        @endif

        <!-- Produits similaires -->
        @if($similarProducts->count() > 0)
            <div class="border-t border-gray-200 pt-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Produits similaires</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($similarProducts as $similarProduct)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                            <div class="relative aspect-w-1 aspect-h-1 bg-gray-200 overflow-hidden">
                                <img src="{{ $similarProduct->main_image_url }}" 
                                     alt="{{ $similarProduct->name }}" 
                                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                                
                                @if($similarProduct->hasDiscount())
                                    <div class="absolute top-2 left-2">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            -{{ $similarProduct->discount_percentage }}%
                                        </span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-900 group-hover:text-indigo-600 transition-colors duration-300 line-clamp-2 mb-2">
                                    <a href="{{ route('products.show', $similarProduct) }}" class="hover:underline">
                                        {{ $similarProduct->name }}
                                    </a>
                                </h3>
                                
                                <div class="flex items-center justify-between">
                                    @if($similarProduct->hasDiscount())
                                        <div class="flex items-center space-x-2">
                                            <span class="text-lg font-bold text-red-600">{{ number_format($similarProduct->price, 2) }} €</span>
                                            <span class="text-sm text-gray-500 line-through">{{ number_format($similarProduct->compare_price, 2) }} €</span>
                                        </div>
                                    @else
                                        <span class="text-lg font-bold text-indigo-600">{{ number_format($similarProduct->price, 2) }} €</span>
                                    @endif
                                    
                                    <a href="{{ route('products.show', $similarProduct) }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                                        Voir
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

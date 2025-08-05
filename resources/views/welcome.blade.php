@extends('layouts.public')

@section('title', 'Accueil')
@section('description', 'Découvrez Luxylia avec des milliers de produits de qualité')

@section('content')

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Découvrez Luxylia
                </h1>
                <p class="text-xl mb-8 max-w-2xl mx-auto">
                    Trouvez tout ce dont vous avez besoin parmi des milliers de produits de qualité, vendus par des vendeurs de confiance.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Parcourir les produits
                    </a>
                    <a href="{{ route('products.featured') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition-colors">
                        Produits en vedette
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Catégories populaires -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Catégories populaires</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $categories = \App\Models\Category::active()->take(9)->get();

                // Fallback si pas assez de catégories en base
                if($categories->count() < 6) {
                    $defaultCategories = collect([
                        (object)['id' => 1, 'name' => 'Électronique', 'slug' => 'electronique', 'description' => 'Smartphones, ordinateurs, accessoires tech', 'image' => null],
                        (object)['id' => 2, 'name' => 'Mode & Beauté', 'slug' => 'mode-beaute', 'description' => 'Vêtements, chaussures, cosmétiques', 'image' => null],
                        (object)['id' => 3, 'name' => 'Maison & Jardin', 'slug' => 'maison-jardin', 'description' => 'Décoration, meubles, jardinage', 'image' => null],
                        (object)['id' => 4, 'name' => 'Sport & Loisirs', 'slug' => 'sport-loisirs', 'description' => 'Équipements sportifs, jeux, hobbies', 'image' => null],
                        (object)['id' => 5, 'name' => 'Auto & Moto', 'slug' => 'auto-moto', 'description' => 'Véhicules, pièces détachées, accessoires', 'image' => null],
                        (object)['id' => 6, 'name' => 'Livres & Culture', 'slug' => 'livres-culture', 'description' => 'Livres, musique, films, art', 'image' => null],
                        (object)['id' => 7, 'name' => 'Santé & Bien-être', 'slug' => 'sante-bien-etre', 'description' => 'Produits de santé, fitness, relaxation', 'image' => null],
                        (object)['id' => 8, 'name' => 'Enfants & Bébés', 'slug' => 'enfants-bebes', 'description' => 'Jouets, vêtements, puériculture', 'image' => null],
                        (object)['id' => 9, 'name' => 'Alimentation', 'slug' => 'alimentation', 'description' => 'Produits frais, épicerie, boissons', 'image' => null],
                    ]);
                    $categories = $categories->concat($defaultCategories)->take(9);
                }
            @endphp
            @foreach($categories as $category)
                <a href="{{ isset($category->id) && $category->id <= 1000 ? route('categories.index') : route('categories.show', $category) }}" class="group">
                    <div class="bg-white rounded-xl shadow-md p-8 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100">
                        @if($category->image)
                            <div class="w-20 h-20 mx-auto mb-6 rounded-full overflow-hidden">
                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                        @else
                            @php
                                $categoryIcons = [
                                    'Électronique' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>',
                                    'Mode & Beauté' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>',
                                    'Maison & Jardin' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>',
                                    'Sport & Loisirs' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>',
                                    'Auto & Moto' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>',
                                    'Livres & Culture' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>',
                                    'Santé & Bien-être' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>',
                                    'Enfants & Bébés' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
                                    'Alimentation' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>'
                                ];
                                $iconPath = $categoryIcons[$category->name] ?? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>';
                            @endphp
                            <div class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:from-indigo-200 group-hover:to-purple-200 transition-all duration-300">
                                <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $iconPath !!}
                                </svg>
                            </div>
                        @endif
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-300 mb-2">
                            {{ $category->name }}
                        </h3>
                        @if($category->description)
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ Str::limit($category->description, 80) }}</p>
                        @endif
                        <div class="flex items-center justify-center text-sm text-indigo-600 font-medium group-hover:text-indigo-700">
                            <span>Découvrir</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Bouton voir toutes les catégories -->
        <div class="text-center mt-12">
            <a href="{{ route('categories.index') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7H5m14 14H5"></path>
                </svg>
                Voir toutes les catégories
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Produits en vedette -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Produits en vedette</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $featuredProducts = \App\Models\Product::with(['category', 'user'])->featured()->active()->inStock()->take(4)->get();
                @endphp
                @foreach($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                            @if($product->main_image)
                                <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $product->category->name }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-indigo-600">{{ number_format($product->price, 2) }} €</span>
                                @auth
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700 transition-colors">
                                            Ajouter
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700 transition-colors">
                                        Connexion
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('products.featured') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                    Voir tous les produits en vedette
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Marketplace</h3>
                    <p class="text-gray-300">
                        Votre destination en ligne pour trouver des produits de qualité vendus par des vendeurs de confiance.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white">Produits</a></li>
                        <li><a href="{{ route('products.featured') }}" class="text-gray-300 hover:text-white">En vedette</a></li>
                        @auth
                            <li><a href="{{ route('orders.index') }}" class="text-gray-300 hover:text-white">Mes commandes</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Aide</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">FAQ</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Livraison</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

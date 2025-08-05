@extends('layouts.public')

@section('title', 'Démonstration Catégories')
@section('description', 'Aperçu de la nouvelle section catégories avec 3 par ligne')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                Démonstration des Catégories
            </h1>
            <p class="mt-4 text-xl text-gray-600">
                Aperçu de la nouvelle section avec 3 catégories par ligne
            </p>
        </div>

        <!-- Section Catégories Populaires -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-16">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">Catégories populaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $demoCategories = [
                        ['name' => 'Électronique', 'description' => 'Smartphones, ordinateurs, accessoires tech', 'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z'],
                        ['name' => 'Mode & Beauté', 'description' => 'Vêtements, chaussures, cosmétiques', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                        ['name' => 'Maison & Jardin', 'description' => 'Décoration, meubles, jardinage', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['name' => 'Sport & Loisirs', 'description' => 'Équipements sportifs, jeux, hobbies', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                        ['name' => 'Auto & Moto', 'description' => 'Véhicules, pièces détachées, accessoires', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
                        ['name' => 'Livres & Culture', 'description' => 'Livres, musique, films, art', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['name' => 'Santé & Bien-être', 'description' => 'Produits de santé, fitness, relaxation', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                        ['name' => 'Enfants & Bébés', 'description' => 'Jouets, vêtements, puériculture', 'icon' => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['name' => 'Alimentation', 'description' => 'Produits frais, épicerie, boissons', 'icon' => 'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7']
                    ];
                @endphp

                @foreach($demoCategories as $category)
                    <a href="{{ route('categories.index') }}" class="group">
                        <div class="bg-white rounded-xl shadow-md p-8 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100">
                            <div class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:from-indigo-200 group-hover:to-purple-200 transition-all duration-300">
                                <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $category['icon'] }}"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-300 mb-2">
                                {{ $category['name'] }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $category['description'] }}</p>
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

        <!-- Informations sur les changements -->
        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6">
            <h2 class="text-xl font-semibold text-indigo-900 mb-4">✨ Améliorations apportées</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-indigo-800">
                <div>
                    <h3 class="font-semibold mb-2">🎨 Design</h3>
                    <ul class="space-y-1">
                        <li>• 3 catégories par ligne au lieu de 6</li>
                        <li>• Cartes plus grandes et plus lisibles</li>
                        <li>• Icônes spécifiques par catégorie</li>
                        <li>• Animations au survol améliorées</li>
                        <li>• Dégradés de couleurs modernes</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-2">⚡ Fonctionnalités</h3>
                    <ul class="space-y-1">
                        <li>• Descriptions des catégories</li>
                        <li>• Bouton "Découvrir" avec animation</li>
                        <li>• Fallback avec catégories par défaut</li>
                        <li>• Bouton "Voir toutes les catégories"</li>
                        <li>• Responsive design optimisé</li>
                    </ul>
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

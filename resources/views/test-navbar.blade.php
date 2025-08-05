@extends('layouts.public')

@section('title', 'Test Navbar')
@section('description', 'Page de test pour la navbar Luxylia')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                Test de la Navbar
            </h1>
            <p class="mt-4 text-xl text-gray-600">
                Cette page permet de tester tous les éléments de la navbar
            </p>
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Section Visiteurs -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">🌐 Partie Visiteurs</h2>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>✅ Accueil</li>
                        <li>✅ Produits</li>
                        <li>✅ Catégories (avec dropdown)</li>
                        <li>✅ En vedette</li>
                        <li>✅ Contact</li>
                        <li>✅ Connexion/Inscription</li>
                    </ul>
                </div>

                <!-- Section Client -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">🙋 Partie Client</h2>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>✅ Mon panier (avec compteur)</li>
                        <li>✅ Mes commandes</li>
                        <li>✅ Favoris</li>
                        <li>✅ Messages (Chatify)</li>
                        <li>✅ Mon compte (dropdown)</li>
                        <li>✅ Déconnexion</li>
                    </ul>
                </div>

                <!-- Section Vendeur -->
                <div class="bg-orange-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">🧑‍💼 Partie Vendeur</h2>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>✅ Dashboard vendeur</li>
                        <li>✅ Mes produits</li>
                        <li>✅ Ajouter un produit</li>
                        <li>✅ Mes ventes</li>
                        <li>✅ Messages (Chatify)</li>
                    </ul>
                </div>

                <!-- Section Admin -->
                <div class="bg-red-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">🛠️ Partie Admin</h2>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>✅ Dashboard admin</li>
                        <li>✅ Gestion utilisateurs</li>
                        <li>✅ Gestion produits</li>
                        <li>✅ Signalements</li>
                    </ul>
                </div>

                <!-- Section Responsive -->
                <div class="bg-green-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">📱 Responsive</h2>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>✅ Menu hamburger mobile</li>
                        <li>✅ Navigation adaptative</li>
                        <li>✅ Dropdowns fonctionnels</li>
                        <li>✅ Icônes Heroicons</li>
                    </ul>
                </div>

                <!-- Section Fonctionnalités -->
                <div class="bg-purple-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">⚡ Fonctionnalités</h2>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>✅ Directives Blade (@auth, @guest)</li>
                        <li>✅ Vérification des rôles</li>
                        <li>✅ Navigation contextuelle</li>
                        <li>✅ Animations Tailwind</li>
                        <li>✅ Alpine.js pour l'interactivité</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Instructions de test -->
        <div class="mt-16 bg-indigo-50 border border-indigo-200 rounded-lg p-6">
            <h2 class="text-xl font-semibold text-indigo-900 mb-4">📋 Instructions de test</h2>
            <div class="text-sm text-indigo-800 space-y-2">
                <p><strong>1. Test en tant que visiteur :</strong> Déconnectez-vous pour voir les liens de connexion/inscription</p>
                <p><strong>2. Test en tant que client :</strong> Connectez-vous avec un compte client pour voir le menu utilisateur</p>
                <p><strong>3. Test en tant que vendeur :</strong> Connectez-vous avec un compte vendeur pour voir le menu vendeur</p>
                <p><strong>4. Test en tant qu'admin :</strong> Connectez-vous avec un compte admin pour voir le menu admin</p>
                <p><strong>5. Test responsive :</strong> Réduisez la taille de la fenêtre pour voir le menu hamburger</p>
            </div>
        </div>

        <!-- Comptes de test -->
        @if(app()->environment('local'))
        <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-6">
            <h2 class="text-xl font-semibold text-yellow-900 mb-4">🔑 Comptes de test (environnement local)</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div class="bg-white p-4 rounded border">
                    <h3 class="font-semibold text-gray-900">Admin</h3>
                    <p class="text-gray-600">Email: admin@luxylia.com</p>
                    <p class="text-gray-600">Mot de passe: password</p>
                </div>
                <div class="bg-white p-4 rounded border">
                    <h3 class="font-semibold text-gray-900">Client</h3>
                    <p class="text-gray-600">Email: client@luxylia.com</p>
                    <p class="text-gray-600">Mot de passe: password</p>
                </div>
                <div class="bg-white p-4 rounded border">
                    <h3 class="font-semibold text-gray-900">Vendeur</h3>
                    <p class="text-gray-600">Email: seller1@luxylia.com</p>
                    <p class="text-gray-600">Mot de passe: password</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

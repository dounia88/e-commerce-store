<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Luxylia')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- SEO Meta Tags -->
        <meta name="description" content="@yield('description', 'Luxylia - Achetez et vendez en ligne')">
        <meta name="keywords" content="@yield('keywords', 'luxylia, marketplace, e-commerce, achat, vente, produits')">
        
        @stack('head')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">
            {{-- Navigation --}}
            @include('layouts.navbar')

            {{-- Page Content --}}
            <main>
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="bg-gray-800 text-white">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Luxylia</h3>
                            <p class="text-gray-300">Votre plateforme de confiance pour acheter et vendre en ligne.</p>
                        </div>
                        <div>
                            <h4 class="text-md font-semibold mb-4">Navigation</h4>
                            <ul class="space-y-2">
                                <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Accueil</a></li>
                                <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white">Produits</a></li>
                                <li><a href="{{ route('categories.index') }}" class="text-gray-300 hover:text-white">Catégories</a></li>
                                <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white">Contact</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-md font-semibold mb-4">Compte</h4>
                            <ul class="space-y-2">
                                @guest
                                    <li><a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Connexion</a></li>
                                    <li><a href="{{ route('register') }}" class="text-gray-300 hover:text-white">Inscription</a></li>
                                @else
                                    <li><a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-white">Mon profil</a></li>
                                    <li><a href="{{ route('orders.index') }}" class="text-gray-300 hover:text-white">Mes commandes</a></li>
                                @endguest
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-md font-semibold mb-4">Support</h4>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-300 hover:text-white">FAQ</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Aide</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Conditions d'utilisation</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white">Politique de confidentialité</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                        <p class="text-gray-300">&copy; {{ date('Y') }} Luxylia. Tous droits réservés.</p>
                    </div>
                </div>
            </footer>
        </div>

        @stack('scripts')
    </body>
</html>

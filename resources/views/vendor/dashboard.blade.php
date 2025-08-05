<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Vendeur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-700">Produits</h3>
                                <p class="text-3xl font-bold text-blue-600">{{ $totalProducts }}</p>
                                <p class="text-sm text-gray-500">{{ $activeProducts }} actifs</p>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-full">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-700">Commandes</h3>
                                <p class="text-3xl font-bold text-green-600">{{ $totalOrders }}</p>
                                <p class="text-sm text-gray-500">Total reçues</p>
                            </div>
                            <div class="p-3 bg-green-100 rounded-full">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-700">Revenus</h3>
                                <p class="text-3xl font-bold text-purple-600">${{ number_format($totalRevenue, 2) }}</p>
                                <p class="text-sm text-gray-500">Total généré</p>
                            </div>
                            <div class="p-3 bg-purple-100 rounded-full">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-700">Actions</h3>
                                <a href="{{ route('vendor.products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Nouveau Produit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produits récents et Commandes récentes -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Produits récents -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Produits récents</h3>
                        <div class="space-y-4">
                            @forelse($recentProducts as $product)
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $product->image ? asset($product->image) : 'https://via.placeholder.com/60' }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-12 h-12 rounded-lg object-cover">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $product->name }}</h4>
                                        <p class="text-sm text-gray-500">${{ number_format($product->price, 2) }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-gray-500">Aucun produit trouvé.</p>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('vendor.products.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Voir tous les produits →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Commandes récentes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Commandes récentes</h3>
                        <div class="space-y-4">
                            @forelse($recentOrders as $order)
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $order->order_number }}</h4>
                                        <p class="text-sm text-gray-500">{{ $order->user->name }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-900">${{ number_format($order->total_price, 2) }}</p>
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">Aucune commande trouvée.</p>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('vendor.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Voir toutes les commandes →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

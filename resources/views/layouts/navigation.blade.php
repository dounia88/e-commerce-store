<nav x-data="{ open: false }" class="bg-white border-b border-green-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('products.index') }}" class="text-2xl font-bold text-green-600">
                        Luxora
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="text-green-700 hover:text-green-900">
                        {{ __('Produits') }}
                    </x-nav-link>
                    
                    @auth
                        <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')" class="text-green-700 hover:text-green-900">
                            {{ __('Mes Commandes') }}
                        </x-nav-link>
                        
                        @role('admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')" class="text-green-700 hover:text-green-900">
                                {{ __('Admin') }}
                            </x-nav-link>
                        @endrole
                    @endauth
                </div>
            </div>

            <!-- Right side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <!-- Cart -->
                @auth
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-green-600 hover:text-green-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                        </svg>
                        @if(Auth::user()->cart_items_count > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ Auth::user()->cart_items_count }}
                            </span>
                        @endif
                    </a>
                @endauth

                <!-- Settings Dropdown -->
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-600 bg-white hover:text-green-800 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-green-600 hover:text-green-800">Connexion</a>
                        <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Inscription</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                {{ __('Produits') }}
            </x-responsive-nav-link>
            
            @auth
                <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')">
                    {{ __('Panier') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                    {{ __('Mes Commandes') }}
                </x-responsive-nav-link>
                
                @role('admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                        {{ __('Admin') }}
                    </x-responsive-nav-link>
                @endrole
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-green-200">
                <div class="px-4">
                    <div class="font-medium text-base text-green-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-green-600">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>

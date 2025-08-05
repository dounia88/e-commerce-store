<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finaliser la commande') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Formulaire de commande -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Informations de livraison</h3>
                        
                        <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            
                            <!-- Adresse de livraison -->
                            <div class="space-y-4 mb-6">
                                <h4 class="font-medium text-gray-700">Adresse de livraison</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="shipping_first_name" class="block text-sm font-medium text-gray-700">Prénom</label>
                                        <input type="text" name="shipping_address[first_name]" id="shipping_first_name" 
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                               required>
                                    </div>
                                    <div>
                                        <label for="shipping_last_name" class="block text-sm font-medium text-gray-700">Nom</label>
                                        <input type="text" name="shipping_address[last_name]" id="shipping_last_name" 
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                               required>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="shipping_address_line" class="block text-sm font-medium text-gray-700">Adresse</label>
                                    <input type="text" name="shipping_address[address_line]" id="shipping_address_line" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                           required>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="shipping_city" class="block text-sm font-medium text-gray-700">Ville</label>
                                        <input type="text" name="shipping_address[city]" id="shipping_city" 
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                               required>
                                    </div>
                                    <div>
                                        <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700">Code postal</label>
                                        <input type="text" name="shipping_address[postal_code]" id="shipping_postal_code" 
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                               required>
                                    </div>
                                    <div>
                                        <label for="shipping_country" class="block text-sm font-medium text-gray-700">Pays</label>
                                        <input type="text" name="shipping_address[country]" id="shipping_country" 
                                               value="France"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                               required>
                                    </div>
                                </div>
                            </div>

                            <!-- Adresse de facturation -->
                            <div class="space-y-4 mb-6">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-medium text-gray-700">Adresse de facturation</h4>
                                    <label class="flex items-center">
                                        <input type="checkbox" id="same-as-shipping" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked>
                                        <span class="ml-2 text-sm text-gray-600">Identique à l'adresse de livraison</span>
                                    </label>
                                </div>
                                
                                <div id="billing-address" class="hidden space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="billing_first_name" class="block text-sm font-medium text-gray-700">Prénom</label>
                                            <input type="text" name="billing_address[first_name]" id="billing_first_name" 
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label for="billing_last_name" class="block text-sm font-medium text-gray-700">Nom</label>
                                            <input type="text" name="billing_address[last_name]" id="billing_last_name" 
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                    </div>
                                    <!-- Autres champs de facturation similaires... -->
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="mb-6">
                                <label for="notes" class="block text-sm font-medium text-gray-700">Notes de commande (optionnel)</label>
                                <textarea name="notes" id="notes" rows="3" 
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                          placeholder="Instructions spéciales pour la livraison..."></textarea>
                            </div>

                            <!-- Paiement Stripe -->
                            <div class="space-y-4">
                                <h4 class="font-medium text-gray-700">Paiement</h4>
                                <div id="card-element" class="p-3 border border-gray-300 rounded-md">
                                    <!-- Stripe Elements will create form elements here -->
                                </div>
                                <div id="card-errors" role="alert" class="text-red-600 text-sm"></div>
                            </div>

                            <input type="hidden" name="payment_method_id" id="payment_method_id">
                        </form>
                    </div>
                </div>

                <!-- Résumé de commande -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Résumé de la commande</h3>
                        
                        <div class="space-y-4 mb-6">
                            @foreach($cartItems as $item)
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $item->product->image ? asset($item->product->image) : 'https://via.placeholder.com/60' }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-12 h-12 rounded-lg object-cover">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-500">Quantité: {{ $item->quantity }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-900">${{ number_format($item->quantity * $item->product->price, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-200 pt-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>Sous-total</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Livraison</span>
                                <span>Gratuite</span>
                            </div>
                            <div class="flex justify-between text-lg font-semibold border-t border-gray-200 pt-2">
                                <span>Total</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" form="checkout-form" id="submit-payment" 
                                class="w-full mt-6 bg-blue-600 border border-transparent rounded-md py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="button-text">Finaliser la commande</span>
                            <span id="spinner" class="hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Traitement...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Configuration Stripe
        const stripe = Stripe('{{ config("services.stripe.key") }}');
        const elements = stripe.elements();

        // Créer l'élément de carte
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#424770',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
            },
        });

        cardElement.mount('#card-element');

        // Gérer les erreurs en temps réel
        cardElement.on('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Gérer la soumission du formulaire
        const form = document.getElementById('checkout-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const submitButton = document.getElementById('submit-payment');
            const buttonText = document.getElementById('button-text');
            const spinner = document.getElementById('spinner');

            // Désactiver le bouton et afficher le spinner
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            spinner.classList.remove('hidden');

            const {token, error} = await stripe.createToken(cardElement);

            if (error) {
                // Afficher l'erreur
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;

                // Réactiver le bouton
                submitButton.disabled = false;
                buttonText.classList.remove('hidden');
                spinner.classList.add('hidden');
            } else {
                // Soumettre le formulaire avec le token
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                form.submit();
            }
        });

        // Gérer l'adresse de facturation
        document.getElementById('same-as-shipping').addEventListener('change', function() {
            const billingAddress = document.getElementById('billing-address');
            if (this.checked) {
                billingAddress.classList.add('hidden');
            } else {
                billingAddress.classList.remove('hidden');
            }
        });
    </script>
</x-app-layout>

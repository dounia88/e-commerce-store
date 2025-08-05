@extends('layouts.public')

@section('title', 'Contact')
@section('description', 'Contactez-nous pour toute question ou demande d\'information')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg mx-auto md:max-w-none md:grid md:grid-cols-2 md:gap-8">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                    Contactez-nous
                </h2>
                <div class="mt-3">
                    <p class="text-lg text-gray-500">
                        Nous sommes là pour vous aider. N'hésitez pas à nous contacter pour toute question.
                    </p>
                </div>
                <div class="mt-9">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 text-base text-gray-500">
                            <p>+33 1 23 45 67 89</p>
                        </div>
                    </div>
                    <div class="mt-6 flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 text-base text-gray-500">
                            <p>contact@luxylia.com</p>
                        </div>
                    </div>
                    <div class="mt-6 flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 text-base text-gray-500">
                            <p>123 Rue de Luxylia<br>75001 Paris, France</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 sm:mt-16 md:mt-0">
                <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                    Envoyez-nous un message
                </h2>
                <div class="mt-3">
                    <form action="#" method="POST" class="grid grid-cols-1 gap-y-6">
                        @csrf
                        <div>
                            <label for="name" class="sr-only">Nom</label>
                            <input type="text" name="name" id="name" autocomplete="name" placeholder="Votre nom" class="block w-full shadow-sm py-3 px-4 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input id="email" name="email" type="email" autocomplete="email" placeholder="Votre email" class="block w-full shadow-sm py-3 px-4 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="subject" class="sr-only">Sujet</label>
                            <input type="text" name="subject" id="subject" placeholder="Sujet" class="block w-full shadow-sm py-3 px-4 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="message" class="sr-only">Message</label>
                            <textarea id="message" name="message" rows="4" placeholder="Votre message" class="block w-full shadow-sm py-3 px-4 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 border border-gray-300 rounded-md"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Envoyer le message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

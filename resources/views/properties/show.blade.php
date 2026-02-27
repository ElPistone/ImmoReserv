<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $property->title }}
            </h2>
            <a href="{{ route('properties.index') }}" class="text-primary hover:underline">
                ← Retour à la liste
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Colonne image -->
                        <div>
                            <img src="{{ $property->image_url ?? 'https://via.placeholder.com/800x600' }}" 
                                 alt="{{ $property->title }}"
                                 class="w-full h-96 object-cover rounded-lg shadow-md">
                        </div>
                        
                        <!-- Colonne informations -->
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $property->title }}</h1>
                            
                            <div class="flex items-center text-gray-600 mb-4">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $property->address }}, {{ $property->city }}, {{ $property->country }}</span>
                            </div>
                            
                            <div class="flex space-x-6 mb-6">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-primary">{{ $property->bedrooms }}</div>
                                    <div class="text-sm text-gray-500">Chambres</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-primary">{{ $property->bathrooms }}</div>
                                    <div class="text-sm text-gray-500">Salles de bain</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-primary">{{ $property->max_guests }}</div>
                                    <div class="text-sm text-gray-500">Voyageurs max</div>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                                <p class="text-gray-600">{{ $property->description }}</p>
                            </div>
                            
                            <div class="border-t pt-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-2xl font-bold text-primary">{{ number_format($property->price_per_night, 2) }}€</span>
                                    <span class="text-gray-500">par nuit</span>
                                </div>
                                
                                @auth
                                    <!-- Ici on mettra le composant Livewire plus tard -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-center text-gray-600">
                                            Connecté en tant que {{ Auth::user()->name }} - La réservation arrivera bientôt !
                                        </p>
                                    </div>
                                @else
                                    <div class="bg-yellow-50 p-4 rounded-lg">
                                        <p class="text-center text-yellow-800">
                                            <a href="{{ route('login') }}" class="font-semibold hover:underline">Connectez-vous</a> 
                                            ou 
                                            <a href="{{ route('register') }}" class="font-semibold hover:underline">inscrivez-vous</a> 
                                            pour réserver ce bien.
                                        </p>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
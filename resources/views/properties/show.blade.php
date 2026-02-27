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
            <!-- Grille principale 66% / 33% -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Colonne de gauche (66% - 2/3 de la largeur) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Image principale -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <img src="{{ $property->image_url ?? 'https://via.placeholder.com/1200x600' }}" 
                             alt="{{ $property->title }}"
                             class="w-full h-96 object-cover">
                    </div>
                    
                    <!-- Informations détaillées -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $property->title }}</h1>
                        
                        <!-- Localisation -->
                        <div class="flex items-center text-gray-600 mb-6">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-lg">{{ $property->address }}, {{ $property->city }}, {{ $property->country }}</span>
                        </div>
                        
                        <!-- Caractéristiques en badges -->
                        <div class="flex flex-wrap gap-4 mb-6">
                            <div class="bg-gray-100 rounded-full px-4 py-2 flex items-center">
                                <span class="text-2xl mr-2">🛏️</span>
                                <span class="font-semibold">{{ $property->bedrooms }} chambre(s)</span>
                            </div>
                            <div class="bg-gray-100 rounded-full px-4 py-2 flex items-center">
                                <span class="text-2xl mr-2">🚿</span>
                                <span class="font-semibold">{{ $property->bathrooms }} salle(s) de bain</span>
                            </div>
                            <div class="bg-gray-100 rounded-full px-4 py-2 flex items-center">
                                <span class="text-2xl mr-2">👥</span>
                                <span class="font-semibold">{{ $property->max_guests }} voyageur(s) max</span>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="prose max-w-none">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">À propos de ce logement</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $property->description }}</p>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Colonne de droite (33% - 1/3 de la largeur) - RÉSERVATION -->
                <div class="lg:col-span-1">
                    <!-- Carte de réservation sticky -->
                    <div class="sticky top-6">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <!-- Prix -->
                            <div class="flex items-center justify-between mb-6 pb-4 border-b">
                                <div>
                                    <span class="text-3xl font-bold text-primary">{{ number_format($property->price_per_night, 2) }}€</span>
                                    <span class="text-gray-500">/ nuit</span>
                                </div>
                                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    Disponible
                                </div>
                            </div>
                            
                            @auth
                                <!-- Composant Livewire pour la réservation -->
                                <livewire:booking-manager :property="$property" wire:key="booking-{{ $property->id }}" />
                            @else
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                                    <svg class="h-12 w-12 text-yellow-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <p class="text-yellow-800 font-medium mb-3">
                                        Connectez-vous pour réserver ce bien
                                    </p>
                                    <div class="space-y-2">
                                        <a href="{{ route('login') }}" 
                                           class="block w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-primary-dark transition-colors duration-300">
                                            Se connecter
                                        </a>
                                        <a href="{{ route('register') }}" 
                                           class="block w-full bg-gray-100 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-200 transition-colors duration-300">
                                            Créer un compte
                                        </a>
                                    </div>
                                </div>
                            @endauth
                            
                            <!-- Informations complémentaires -->
                            <div class="mt-4 text-xs text-gray-400 text-center">
                                * Vous ne serez débité qu'à la confirmation
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
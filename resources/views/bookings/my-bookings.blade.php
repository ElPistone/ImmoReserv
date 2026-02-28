<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mes réservations') }}
            </h2>
            <a href="{{ route('properties.index') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Réserver un bien
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            
            @if($bookings->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <!-- Illustration vide -->
                        <div class="flex justify-center mb-6">
                            <svg class="w-32 h-32 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        
                        <h3 class="text-2xl font-semibold text-gray-700 mb-3">
                            Aucune réservation pour le moment
                        </h3>
                        
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            Vous n'avez pas encore effectué de réservation. Découvrez nos magnifiques propriétés et trouvez votre prochain séjour de rêve !
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('properties.index') }}" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors font-semibold">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Explorer les propriétés
                            </a>
                            
                            <a href="{{ route('profile.edit') }}" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Compléter mon profil
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($bookings as $booking)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                            <!-- Image de la propriété -->
                            <div class="h-48 bg-cover bg-center relative" 
                                 style="background-image: url('{{ $booking->property->image_url ?? 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800' }}')">
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold shadow-lg
                                        @if($booking->status->value === 'confirmée') bg-green-500 text-white
                                        @elseif($booking->status->value === 'en-cours') bg-yellow-500 text-white
                                        @elseif($booking->status->value === 'annulée') bg-red-500 text-white
                                        @endif">
                                        {{ $booking->status->label() }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">
                                    {{ $booking->property->title }}
                                </h3>
                                
                                <div class="flex items-center text-gray-600 mb-4">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-sm">{{ $booking->property->city }}, {{ $booking->property->country }}</span>
                                </div>
                                
                                <!-- Dates -->
                                <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3 mb-4">
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500">Arrivée</p>
                                        <p class="font-semibold text-primary">{{ $booking->start_date->format('d/m/Y') }}</p>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500">Départ</p>
                                        <p class="font-semibold text-primary">{{ $booking->end_date->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                
                                <!-- Détails -->
                                <div class="grid grid-cols-2 gap-3 mb-4">
                                    <div class="bg-gray-50 rounded p-2 text-center">
                                        <p class="text-xs text-gray-500">Invitée(s)</p>
                                        <p class="font-semibold">{{ $booking->guests }}</p>
                                    </div>
                                    <div class="bg-gray-50 rounded p-2 text-center">
                                        <p class="text-xs text-gray-500">Nuitée(s)</p>
                                        <p class="font-semibold">{{ $booking->nights }}</p>
                                    </div>
                                </div>
                                
                                <!-- Prix total -->
                                <div class="flex justify-between items-center border-t pt-4 mb-4">
                                    <span class="text-gray-600">Total</span>
                                    <span class="text-2xl font-bold text-primary">{{ number_format($booking->total_price, 2) }}€</span>
                                </div>
                                
                                @if($booking->special_requests)
                                    <div class="mb-4 p-3 bg-blue-50 rounded-lg">
                                        <p class="text-sm text-blue-700">
                                            <span class="font-semibold">✏️ Demande :</span><br>
                                            {{ $booking->special_requests }}
                                        </p>
                                    </div>
                                @endif
                                
                                @if($booking->isModifiable())
                                    <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full text-center text-sm text-red-600 hover:text-red-800 border border-red-200 hover:border-red-300 rounded-md py-2 transition-colors"
                                                onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                            Annuler la réservation
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
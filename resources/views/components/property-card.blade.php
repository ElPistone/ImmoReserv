@props(['property'])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <img src="{{ $property->image_url ?? 'https://via.placeholder.com/400x300' }}" 
         alt="{{ $property->title }}"
         class="w-full h-48 object-cover">
    
    <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-900 mb-2">
            {{ $property->title }}
        </h3>
        
        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
            {{ $property->description }}
        </p>
        
        <div class="flex items-center text-sm text-gray-500 mb-3">
            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>{{ $property->city }}, {{ $property->country }}</span>
        </div>
        
        <div class="flex items-center justify-between">
            <div>
                <span class="text-2xl font-bold text-primary">{{ number_format($property->price_per_night, 2) }}€</span>
                <span class="text-gray-500 text-sm">/ nuit</span>
            </div>
            
            <div class="flex space-x-2">
                <span class="text-sm text-gray-500" title="Nombre de chambres">
                    🛏️ {{ $property->bedrooms }}
                </span>
                <span class="text-sm text-gray-500" title="Nombre de salles de bain">
                    🚿 {{ $property->bathrooms }}
                </span>
                <span class="text-sm text-gray-500" title="Nombre maximum d'invités">
                    👥 {{ $property->max_guests }}
                </span>
            </div>
        </div>
        
        <a href="{{ route('properties.show', $property) }}" 
           class="mt-4 block w-full text-center bg-primary text-white py-2 px-4 rounded-md hover:bg-primary-dark transition-colors duration-300">
            Réserver
        </a>
    </div>
</div>
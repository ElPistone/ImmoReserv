<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Propriétés disponibles') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($properties as $property)
                    <x-property-card :property="$property" />
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">Aucune propriété disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-8">
                {{ $properties->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
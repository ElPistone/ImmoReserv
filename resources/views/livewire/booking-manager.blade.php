<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-xl font-semibold text-gray-900 mb-4">Réserver ce bien</h3>
    
    <!-- Messages de notification -->
    <div x-data="{ show: false, message: '', type: '' }" 
         @booking-error.window="show = true; message = $event.detail[0]; type = 'error'; setTimeout(() => show = false, 5000)"
         @booking-success.window="show = true; message = $event.detail[0]; type = 'success'; setTimeout(() => show = false, 5000)"
         x-show="show"
         x-transition.duration.500ms
         class="mb-4">
        <div x-show="type === 'error'" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <span x-text="message"></span>
        </div>
        <div x-show="type === 'success'" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            <span x-text="message"></span>
        </div>
    </div>
    
    <form wire:submit.prevent="book" class="space-y-4">
        <!-- Date d'arrivée -->
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
                Date d'arrivée
            </label>
            <input type="date" 
                   id="start_date"
                   wire:model.live="start_date"
                   min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            @error('start_date') 
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Date de départ -->
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">
                Date de départ
            </label>
            <input type="date" 
                   id="end_date"
                   wire:model.live="end_date"
                   min="{{ $start_date ? Carbon\Carbon::parse($start_date)->addDay()->format('Y-m-d') : Carbon\Carbon::now()->addDay()->format('Y-m-d') }}"
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            @error('end_date') 
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Nombre d'invités -->
        <div>
            <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">
                Nombre d'invités
            </label>
            <select id="guests" 
                    wire:model.live="guests"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                @for($i = 1; $i <= $property->max_guests; $i++)
                    <option value="{{ $i }}">{{ $i }} {{ $i > 1 ? 'personnes' : 'personne' }}</option>
                @endfor
            </select>
            @error('guests') 
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Prix total -->
        @if($total_price > 0)
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total pour {{ Carbon\Carbon::parse($start_date)->diffInDays(Carbon\Carbon::parse($end_date)) }} nuits :</span>
                    <span class="text-2xl font-bold text-primary">{{ number_format($total_price, 2) }}€</span>
                </div>
            </div>
        @endif
        
        <!-- Bouton de réservation -->
        <button type="submit"
                class="w-full bg-primary text-white py-3 px-4 rounded-md hover:bg-primary-dark transition-colors duration-300 font-semibold"
                wire:loading.attr="disabled"
                wire:target="book">
            <span wire:loading.remove wire:target="book">Réserver maintenant</span>
            <span wire:loading wire:target="book">Traitement en cours...</span>
        </button>
    </form>
    
    <!-- Informations complémentaires -->
    <div class="mt-4 text-sm text-gray-500">
        <p class="flex items-center">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Vous ne serez débité qu'à la confirmation de la réservation.
        </p>
    </div>
</div>
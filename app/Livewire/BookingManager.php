<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;
use App\Models\Booking;
use App\Enums\BookingStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingManager extends Component
{
    public Property $property;
    
    public $start_date = '';
    public $end_date = '';
    public $guests = 1;
    public $total_price = 0;
    
    protected $rules = [
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
        'guests' => 'required|integer|min:1|max:10',
    ];
    
    public function mount(Property $property)
    {
        $this->property = $property;
        $this->guests = min(1, $property->max_guests);
    }
    
    public function updatedStartDate()
    {
        $this->calculateTotalPrice();
    }
    
    public function updatedEndDate()
    {
        $this->calculateTotalPrice();
    }
    
    public function calculateTotalPrice()
    {
        if ($this->start_date && $this->end_date) {
            $start = Carbon::parse($this->start_date);
            $end = Carbon::parse($this->end_date);
            $nights = $start->diffInDays($end);
            
            $this->total_price = $nights * $this->property->price_per_night;
        } else {
            $this->total_price = 0;
        }
    }
    
    public function checkAvailability()
    {
        $this->validate();
        
        if (!$this->property->isAvailableForDates($this->start_date, $this->end_date)) {
            $this->dispatch('booking-error', 'Ces dates ne sont pas disponibles. Veuillez en choisir d\'autres.');
            return false;
        }
        
        return true;
    }
    
    public function book()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!$this->checkAvailability()) {
            return;
        }
        
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'property_id' => $this->property->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'guests' => $this->guests,
            'total_price' => $this->total_price,
            'status' => BookingStatus::PENDING,
            'special_requests' => null
        ]);
        
        $this->dispatch('booking-success', 'Réservation effectuée avec succès !');
        
        // Réinitialiser le formulaire
        $this->reset(['start_date', 'end_date', 'total_price']);
        $this->guests = min(1, $this->property->max_guests);
    }
    
    public function render()
    {
        return view('livewire.booking-manager');
    }
}
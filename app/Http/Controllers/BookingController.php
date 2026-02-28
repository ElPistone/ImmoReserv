<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function myBookings()
    {
        $bookings = Booking::with('property')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('bookings.my-bookings', compact('bookings'));
    }
    public function cancel(Booking $booking)
    {
        // Vérifier que l'utilisateur est bien le propriétaire de la réservation
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }
        
        // Vérifier que la réservation est annulable
        if (!$booking->isModifiable()) {
            return back()->with('error', 'Cette réservation ne peut plus être annulée.');
        }
        
        $booking->update(['status' => \App\Enums\BookingStatus::CANCELLED]);
        
        return redirect()->route('my-bookings')->with('success', 'Réservation annulée avec succès.');
    }
}
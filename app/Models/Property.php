<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price_per_night',
        'address',
        'city',
        'country',
        'bedrooms',
        'bathrooms',
        'max_guests',
        'image_url',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price_per_night' => 'decimal:2',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'max_guests' => 'integer'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailableForDates($startDate, $endDate, $excludeBookingId = null)
    {
        $query = $this->bookings()
            ->where('status', '!=', 'annulée')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            });
        
        if ($excludeBookingId) {
            $query->where('id', '!=', $excludeBookingId);
        }
        
        return $query->count() === 0;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\BookingStatus;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'start_date',
        'end_date',
        'guests',
        'total_price',
        'status',
        'special_requests'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_price' => 'decimal:2',
        'guests' => 'integer',
        'status' => BookingStatus::class
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function getNightsAttribute()
    {
        if ($this->start_date && $this->end_date) {
            return $this->start_date->diffInDays($this->end_date);
        }
        return 0;
    }

    public function isModifiable()
    {
        if ($this->start_date) {
            return $this->status === BookingStatus::PENDING && $this->start_date->isFuture();
        }
        return false;
    }
    
    public function getStatusLabelAttribute()
    {
        return $this->status?->label() ?? 'N/A';
    }
    
    public function getStatusColorAttribute()
    {
        return $this->status?->color() ?? 'gray';
    }
}
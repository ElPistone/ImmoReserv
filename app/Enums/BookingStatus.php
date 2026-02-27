<?php

namespace App\Enums;

enum BookingStatus: string
{
    case CONFIRMED = 'confirmée';
    case PENDING = 'en-cours';
    case CANCELLED = 'annulée';

    public function label(): string
    {
        return match($this) {
            self::CONFIRMED => 'Confirmée',
            self::PENDING => 'En cours',
            self::CANCELLED => 'Annulée',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::CONFIRMED => 'green',
            self::PENDING => 'yellow',
            self::CANCELLED => 'red',
        };
    }

    public static function toArray(): array
    {
        return [
            self::CONFIRMED->value => self::CONFIRMED->label(),
            self::PENDING->value => self::PENDING->label(),
            self::CANCELLED->value => self::CANCELLED->label(),
        ];
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;
use App\Models\Booking;
use App\Enums\BookingStatus;
use Carbon\Carbon;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        // Créer un utilisateur de test si aucun n'existe
        if (User::count() === 0) {
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password')
            ]);
        }

        // Propriétés de test
        $properties = [
            [
                'title' => 'Villa moderne avec piscine',
                'description' => 'Superbe villa moderne avec piscine à débordement, vue imprenable sur la mer.',
                'price_per_night' => 250.00,
                'address' => '123 Avenue de la Plage',
                'city' => 'Nice',
                'country' => 'France',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'max_guests' => 8,
                'image_url' => 'https://images.unsplash.com/photo-1613977257363-707ba9348225?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Appartement cosy centre-ville',
                'description' => 'Appartement charmant au cœur de la ville, proche de tous les commerces.',
                'price_per_night' => 89.00,
                'address' => '45 Rue du Commerce',
                'city' => 'Lyon',
                'country' => 'France',
                'bedrooms' => 2,
                'bathrooms' => 1,
                'max_guests' => 4,
                'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Chalet de montagne luxueux',
                'description' => 'Chalet traditionnel avec vue sur les pistes, cheminée et spa privé.',
                'price_per_night' => 350.00,
                'address' => '789 Route des Neiges',
                'city' => 'Chamonix',
                'country' => 'France',
                'bedrooms' => 5,
                'bathrooms' => 4,
                'max_guests' => 10,
                'image_url' => 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?w=800',
                'is_available' => true
            ]
        ];

        foreach ($properties as $propertyData) {
            Property::create($propertyData);
        }

        // Réservations de test
        $user = User::first();
        $property = Property::first();

        if ($user && $property) {
            // Réservation confirmée (dans 7 jours)
            Booking::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
                'start_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'guests' => 4,
                'total_price' => $property->price_per_night * 3,
                'status' => BookingStatus::CONFIRMED,
                'special_requests' => 'Arrivée tardive prévue vers 22h'
            ]);

            // Réservation en cours (dans 15 jours)
            Booking::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
                'start_date' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(18)->format('Y-m-d'),
                'guests' => 2,
                'total_price' => $property->price_per_night * 3,
                'status' => BookingStatus::PENDING,
                'special_requests' => null
            ]);

            // Réservation annulée (dans 5 jours)
            Booking::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
                'start_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'guests' => 2,
                'total_price' => $property->price_per_night * 2,
                'status' => BookingStatus::CANCELLED,
                'special_requests' => 'Annulé pour raison personnelle'
            ]);

            // Réservation passée (pour tester isFuture)
            Booking::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
                'start_date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'end_date' => Carbon::now()->subDays(7)->format('Y-m-d'),
                'guests' => 3,
                'total_price' => $property->price_per_night * 3,
                'status' => BookingStatus::CONFIRMED,
                'special_requests' => 'Séjour terminé'
            ]);
        }
    }
}
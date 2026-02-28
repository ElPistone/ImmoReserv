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
                'image_url' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800',
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
            ],
            [
                'title' => 'Maison de campagne avec jardin',
                'description' => 'Maison authentique en pierre avec grand jardin, idéale pour famille.',
                'price_per_night' => 120.00,
                'address' => '12 Chemin Rural',
                'city' => 'Provence',
                'country' => 'France',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'max_guests' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1502005229762-cf1b2da7d5c0?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Studio avec terrasse vue mer',
                'description' => 'Petit studio confortable avec terrasse panoramique sur la Méditerranée.',
                'price_per_night' => 75.00,
                'address' => '56 Boulevard du Bord de Mer',
                'city' => 'Antibes',
                'country' => 'France',
                'bedrooms' => 1,
                'bathrooms' => 1,
                'max_guests' => 2,
                'image_url' => 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Penthouse design centre Paris',
                'description' => 'Penthouse contemporain avec piscine privée au cœur de Paris.',
                'price_per_night' => 450.00,
                'address' => '87 Avenue des Champs-Élysées',
                'city' => 'Paris',
                'country' => 'France',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'max_guests' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Villa méditerranéenne Côte d\'Azur',
                'description' => 'Villa grecque blanche avec terrasse, piscine et accès plage privée.',
                'price_per_night' => 380.00,
                'address' => '234 Route Côtière',
                'city' => 'Saint-Tropez',
                'country' => 'France',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'max_guests' => 8,
                'image_url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Cottage anglais en Normandie',
                'description' => 'Charmant cottage typique normand avec colombages et jardin fleuri.',
                'price_per_night' => 95.00,
                'address' => '102 Rue de la Mer',
                'city' => 'Deauville',
                'country' => 'France',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'max_guests' => 4,
                'image_url' => 'https://images.unsplash.com/photo-1570129477492-45a003537e1f?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Loft industriel à Lyon',
                'description' => 'Loft spacieux au style industriel, proche des restaurants et galeries.',
                'price_per_night' => 110.00,
                'address' => '312 Quai de la Saône',
                'city' => 'Lyon',
                'country' => 'France',
                'bedrooms' => 2,
                'bathrooms' => 1,
                'max_guests' => 4,
                'image_url' => 'https://images.unsplash.com/photo-1493857671505-72967e2e2760?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Maison de vignoble en Bourgogne',
                'description' => 'Maison traditionnelle au milieu des vignes avec cave et dégustation.',
                'price_per_night' => 140.00,
                'address' => '456 Route des Vins',
                'city' => 'Beaune',
                'country' => 'France',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'max_guests' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1570129477492-45a003537e1f?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Maison moderne à Cannes',
                'description' => 'Maison épurée avec piscine, spa et vue sur les collines boisées.',
                'price_per_night' => 320.00,
                'address' => '789 Boulevard de la Croisette',
                'city' => 'Cannes',
                'country' => 'France',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'max_guests' => 8,
                'image_url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Riad traditionnel Marrakech',
                'description' => 'Riad authentique avec patio, fontaine et terrasse sur le toit.',
                'price_per_night' => 105.00,
                'address' => '789 Medina',
                'city' => 'Marrakech',
                'country' => 'Maroc',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'max_guests' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Maison d\'hôte en Alsace',
                'description' => 'Maison colorée traditionnelle alsacienne avec table gastronomique.',
                'price_per_night' => 85.00,
                'address' => '23 Rue du Vignoble',
                'city' => 'Strasbourg',
                'country' => 'France',
                'bedrooms' => 2,
                'bathrooms' => 1,
                'max_guests' => 4,
                'image_url' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Maison claire avec veranda',
                'description' => 'Belle maison lumineuse avec grande veranda vue sur nature.',
                'price_per_night' => 130.00,
                'address' => '15 Rue des Chênes',
                'city' => 'Fontainebleau',
                'country' => 'France',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'max_guests' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Résidence bord de rivière',
                'description' => 'Maison moderne en bois avec accès direct à la rivière.',
                'price_per_night' => 155.00,
                'address' => '78 Chemin de la Loire',
                'city' => 'Saint-Nazaire',
                'country' => 'France',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'max_guests' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1501183007986-e0ae4e655371?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Maison minimaliste architecture',
                'description' => 'Maison design épurée avec grandes baies vitrées et jardin zen.',
                'price_per_night' => 200.00,
                'address' => '45 Avenue Moderne',
                'city' => 'Toulouse',
                'country' => 'France',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'max_guests' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Demeure historique Bretagne',
                'description' => 'Manoir classé au charme d\'époque avec parc arborisé.',
                'price_per_night' => 210.00,
                'address' => '89 Rue du Château',
                'city' => 'Rennes',
                'country' => 'France',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'max_guests' => 8,
                'image_url' => 'https://images.unsplash.com/photo-1508873699372-f91e1f6ff0ff?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Maison romantique avec balcons',
                'description' => 'Résidence Belle Époque avec balcons fleuris, terrasse ombragée.',
                'price_per_night' => 145.00,
                'address' => '34 Place du Centre',
                'city' => 'Biarritz',
                'country' => 'France',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'max_guests' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1522551453208-41e96e02ae23?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Chalet contemporary Alpes',
                'description' => 'Chalet moderne avec la technologie smart home et spa privé.',
                'price_per_night' => 290.00,
                'address' => '201 Route d\'Arly',
                'city' => 'Megève',
                'country' => 'France',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'max_guests' => 8,
                'image_url' => 'https://images.unsplash.com/photo-1518184475777-1546861591-9f1c6bcad545?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Maison avec piscine intérieure',
                'description' => 'Maison luxe équipée piscine chauffée, sauna et salle sport.',
                'price_per_night' => 275.00,
                'address' => '567 Boulevard Prestige',
                'city' => 'Bordeaux',
                'country' => 'France',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'max_guests' => 8,
                'image_url' => 'https://images.unsplash.com/photo-1585132340906-ff5a270ff5ad?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Maison d\'artiste en Provence',
                'description' => 'Demeure avec grande verrière atelier, jardin artistique.',
                'price_per_night' => 165.00,
                'address' => '123 Chemin des Cistes',
                'city' => 'Aix-en-Provence',
                'country' => 'France',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'max_guests' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800',
                'is_available' => true
            ],
            [
                'title' => 'Villa portuaire côtière',
                'description' => 'Maison côtière avec vue port, terrasse brise-soleil, cuisine d\'été.',
                'price_per_night' => 195.00,
                'address' => '890 Quai Méditerranée',
                'city' => 'La Ciotat',
                'country' => 'France',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'max_guests' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1560236882-85b9ad47f0a0?w=800',
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
<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        Reservation::insert([
            [
                'client_id' => 1,
                'annonce_id' => 2,
                'date_debut' => '2025-05-10',
                'date_fin' => '2025-05-12',
                'statut' => 'reservee',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id' => 2,
                'annonce_id' => 1,
                'date_debut' => '2025-06-01',
                'date_fin' => '2025-06-05',
                'statut' => 'en attente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id' => 1,
                'annonce_id' => 1,
                'date_debut' => '2025-04-20',
                'date_fin' => '2025-04-22',
                'statut' => 'terminee',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}

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
                'annonce_id' => 1,
                'client_id' => 2,
                'date_debut' => now()->addDays(1),
                'date_fin' => now()->addDays(5),
                'statut' => 'en_attente',
            ],
            [
                'annonce_id' => 2,
                'client_id' => 2,
                'date_debut' => now()->addDays(10),
                'date_fin' => now()->addDays(15),
                'statut' => 'confirmée',
            ],
        ]);
    }
}

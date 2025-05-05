<?php

namespace Database\Seeders;

use App\Models\Reclamation;
use Illuminate\Database\Seeder;

class ReclamationSeeder extends Seeder
{
    public function run(): void
    {
        Reclamation::insert([
            [
                'client_id' => 2,
                'objet_id' => 1,
                'partenaire_id' => 1,
                'sujet' => 'Objet endommagé',
                'message' => 'L\'objet ne correspond pas à la description.',
                'statut' => 'en_cours',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\EvaluationOnAnnonce;
use Illuminate\Database\Seeder;

class EvaluationOnAnnonceSeeder extends Seeder
{
    public function run(): void
    {
        EvaluationOnAnnonce::insert([
            [
                'client_id' => 2,
                'objet_id' => 1,
                'note' => 5,
                'commentaire' => 'L\'objet était exactement comme décrit, parfait.'
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\EvaluationOnClient;
use Illuminate\Database\Seeder;

class EvaluationOnClientSeeder extends Seeder
{
    public function run(): void
    {
        EvaluationOnClient::insert([
            [
                'client_id' => 2,
                'partner_id' => 1,
                'reservation_id' => 1,
                'note' => 4,
                'commentaire' => 'Client ponctuel, respectueux du matériel.'
            ],
        ]);
    }
}

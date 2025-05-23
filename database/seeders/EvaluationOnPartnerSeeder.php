<?php

namespace Database\Seeders;

use App\Models\EvaluationOnPartner;
use Illuminate\Database\Seeder;

class EvaluationOnPartnerSeeder extends Seeder
{
    public function run(): void
    {
        EvaluationOnPartner::insert([
            [
                'partner_id' => 1,
                'client_id' => 2,
                'reservation_id' => 1,
                'note' => 5,
                'commentaire' => 'Très bon service, partenaire sérieux !'
            ],
        ]);
    }
}

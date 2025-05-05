<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Annonce;
use App\Models\Objet;
use Carbon\Carbon;
class AnnoncesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $objets = \App\Models\Objet::all();
    
        foreach ($objets as $objet) {
            \App\Models\Annonce::create([
                'date_debut' => now(),
                'date_fin' => now()->addDays(30),
                'statut' => 'disponible',
                'adresse' => $objet->ville,
                'objet_id' => $objet->id,
                'proprietaire_id' => $objet->proprietaire_id
            ]);
        }
    }
}

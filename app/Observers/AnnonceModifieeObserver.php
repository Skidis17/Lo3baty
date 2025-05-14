<?php


namespace App\Observers;

use App\Models\Annonce;
use App\Models\User;
use App\Models\Utilisateur;
use App\Notifications\AnnonceModifieeNotification;

class AnnonceModifieeObserver
{
    public function updated(Annonce $annonce)
    {
        if ($annonce->wasChanged()) {
            $clients = Utilisateur::where('role', 'client')->get();
            
            foreach ($clients as $client) {
                $client->notify(new AnnonceModifieeNotification($annonce));
            }
        }
    }
}


?>
<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::insert([
            [
                'user_id' => 2,
                'titre' => 'Votre réservation a été acceptée !',
                'contenu' => 'Félicitations ! Votre réservation pour l\'objet "Voiture de luxe" a été acceptée.',
                'contenu_email' => 'Bonjour, votre réservation a été acceptée.',
                'envoyee' => false,
                'lue' => false,
                'annonce_id' => null,
                'reservation_id' => 1, 
            ],
            [
                'user_id' => 1,
                'titre' => 'Nouvelle réclamation sur un de vos objets.',
                'contenu' => 'Un utilisateur a soumis une réclamation concernant votre objet "Bateau télécommandé".',
                'contenu_email' => 'Il y a une nouvelle réclamation concernant l\'objet "Bateau télécommandé".',
                'envoyee' => false,
                'lue' => false,
                'annonce_id' => null, 
                'reservation_id' => null,
            ],
            [
                'user_id' => 2,
                'titre' => 'Nouvelle annonce publiée !',
                'contenu' => 'Vous avez publié une nouvelle annonce pour "Jouet éducatif".',
                'contenu_email' => 'Votre annonce "Jouet éducatif" a été publiée avec succès.',
                'envoyee' => true,
                'lue' => true,
                'annonce_id' => 1, 
                'reservation_id' => null,
            ],
        ]);
    }
}

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
                'titre' => 'Notif 1',
                'contenu' => 'Votre réservation a été acceptée !',
                'lu' => false,
            ],
            [
                'user_id' => 1,
                'titre' => 'Notif 2',
                'contenu' => 'Nouvelle réclamation sur un de vos objets.',
                'lu' => false,
            ],
        ]);
    }
}

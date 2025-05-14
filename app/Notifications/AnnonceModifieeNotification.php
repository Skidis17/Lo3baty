<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AnnonceModifieeNotification extends Notification 
{

    protected $annonce;

    public function __construct($annonce)
    {
        $this->annonce = $annonce;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'annonce_modifiee',
            'annonce_id' => $this->annonce->id,
            'message' => 'Une annonce a été mise à jour: ' . $this->annonce->titre,
            'titre' => $this->annonce->titre,
            'url' => route('annonces.show', $this->annonce->id),
            'created_at' => now()->toDateTimeString()
        ];
    }
}
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EvaluationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $client;
    public $reservation;
    public $objet;

    public function __construct($reservation)
    { 
       
        $this->reservation = $reservation;
        $this->client = $reservation->client;
        $this->objet = $reservation->objet; 
    }
    
    public function build()
    {
        return $this->subject('Merci pour votre réservation chez Lo3baty     !')
                    ->view('client.evaluation_email')
                    ->with([
                        'client' => $this->client,
                        'reservation' => $this->reservation,
                        'objet' => $this->objet,
                    ]);
    }

    /**
     * Get the message content definition.
     */
    
}

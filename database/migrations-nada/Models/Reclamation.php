<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'objet_id',
        'partenaire_id',
        'reservation_id',
        'sujet',
        'message',
        'statut',
    ];

    public function client()
    {
        return $this->belongsTo(Utilisateur::class, 'client_id');
    }

    public function objet()
    {
        return $this->belongsTo(Objet::class, 'objet_id');
    }
    public function partenaire()
    {
        return $this->belongsTo(Utilisateur::class, 'partenaire_id');
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    // Gestion des timestamps
    public $timestamps = true;
}

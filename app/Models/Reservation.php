<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'annonce_id',
        'date_debut',
        'date_fin',
        'statut',
        'evaluation_date',
        'is_evaluation',
        'is_email',
    ];

    protected $casts = [
        'date_creation' => 'datetime',
        'statut' => 'string'
    ];

    // Relations
    public function client()
    {
        return $this->belongsTo(Utilisateur::class, 'client_id');
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class, 'annonce_id');
    }
 
    public function objet()
    {
        return $this->belongsTo(Objet::class);
    }

    public function evaluationOnPartner()
    {
        return $this->hasOne(EvaluationOnPartner::class, 'reservation_id');
    }
}
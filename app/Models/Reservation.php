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
        'is_email',
        'statut',
        'evaluation_date',
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'date_creation' => 'datetime',
        'evaluation_date'=> 'datetime',
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
    
    public function evaluationOnPartner()
    {
        return $this->hasOne(EvaluationOnPartner::class, 'reservation_id');
    }

    public function objet()
{
    return $this->hasOneThrough(Objet::class, Annonce::class, 'id', 'id', 'annonce_id', 'objet_id');
}
}
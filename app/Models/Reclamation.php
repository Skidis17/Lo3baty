<?php

namespace App\Models;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    protected $casts = [
        'date_reponse' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    protected $table = 'reclamations';
    
    protected $fillable = [
        'client_id',
        'sujet',
        'contenu',
        'statut',
        'reponse',
        'piece_jointe',
        'date_reponse'
    ];

    protected $attributes = [
        'statut' => 'en_attente',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function Utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'client_id')->withDefault([
            'name' => 'Utilisateur (ID: '.$this->client_id.') non trouvé'
        ]);
    }

    /**
     * Accessor pour le statut
     */
    public function getStatutAttribute($value)
    {
        return ucfirst(str_replace('_', ' ', $value));
    }

    /**
     * Mutator pour le statut
     */
    public function setStatutAttribute($value)
    {
        $this->attributes['statut'] = strtolower(str_replace(' ', '_', $value));
    }
}
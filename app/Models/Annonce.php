<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'statut',
        'premium',
        'adresse',
        'objet_id',
        'proprietaire_id'
    ];

    protected $casts = [
        'date_publication' => 'datetime',
        'statut' => 'string'
    ];

    // Relations
    public function objet()
    {
        return $this->belongsTo(Objet::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    
    public function proprietaire()
    {
    return $this->belongsTo(Utilisateur::class, 'proprietaire_id');
    }

    // Accessors pour garantir le format DateTime
    public function getDateDebutAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getDateFinAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getDatePublicationAttribute($value)
    {
        return Carbon::parse($value);
    }

    // Vérifie si une période est disponible
    public function isAvailable($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        
        // Vérifie que les dates sont dans la période de l'annonce
        if ($start < $this->date_debut || $end > $this->date_fin) {
            return false;
        }

        // Vérifie les conflits avec les réservations existantes
        return !$this->reservations()
            ->where('statut', '!=', 'annulé')
            ->where(function($query) use ($start, $end) {
                $query->whereBetween('date_debut', [$start, $end])
                      ->orWhereBetween('date_fin', [$start, $end])
                      ->orWhere(function($query) use ($start, $end) {
                          $query->where('date_debut', '<=', $start)
                                ->where('date_fin', '>=', $end);
                      });
            })
            ->exists();
    }

    // Récupère toutes les périodes réservées
    public function getReservedPeriods()
    {
        return $this->reservations()
            ->where('statut', '!=', 'annulé')
            ->get()
            ->map(function($reservation) {
                return [
                    'start' => Carbon::parse($reservation->date_debut)->format('Y-m-d'),
                    'end' => Carbon::parse($reservation->date_fin)->format('Y-m-d'),
                ];
            });
    }

}

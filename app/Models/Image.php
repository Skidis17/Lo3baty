<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{    
    protected $table='image';
    use HasFactory;

    protected $fillable = ['url', 'objet_id'];

    public function objet()
    {
        return $this->belongsTo(Objet::class);
    }
}
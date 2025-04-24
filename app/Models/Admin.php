<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'mot_pass'];

    public function setMotPassAttribute($value)
    {
        $this->attributes['mot_pass'] = Hash::make($value);
    }
}
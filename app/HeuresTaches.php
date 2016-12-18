<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeuresTaches extends Model
{
    protected $fillable = ['heures', 'description', 'user_id', 'tache_id', 'agence_id', 'projet_id'];
}

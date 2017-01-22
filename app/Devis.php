<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    protected $fillable = ['agence_id', 'projet_id', 'user_id', 'valide', 'a_valider'];

    public function projet()
    {
        return $this->belongsTo('App\Projet');
    }
}

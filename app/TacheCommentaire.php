<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TacheCommentaire extends Model
{
    protected $fillable = ['user_id', 'commentaire', 'travail_id', 'agence_id', 'projet_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function agence()
    {
        return $this->belongsTo('App\Agence');
    }

    public function projet()
    {
        return $this->belongsTo('App\Projet');
    }

    public function tache()
    {
        return $this->belongsTo('App\Travail');
    }
}

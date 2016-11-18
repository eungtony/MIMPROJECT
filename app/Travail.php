<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travail extends Model
{
    protected $fillable = ['titre', 'commentaire', 'date', 'projet_id', 'agence_id','user_id', 'fait'];

    public function projet(){
        return $this->belongsTo('App\Projet');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    protected $fillable = ['nom', 'user_id', 'promo_id'];

    public function users(){
        return $this->hasMany('App\User');
    }

    public function projets(){
        return $this->hasMany('App\Projet');
    }

    public function travail(){
        return $this->hasMany('App\Travail');
    }

    public function file(){
        return $this->hasMany('App\File');
    }

    public function promos()
    {
        return $this->belongsTo('App\Promo');
    }

    public function commentaire()
    {
        return $this->hasMany('App\TacheCommentaire');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    protected $fillable = ['etape'];

    public function projet()
    {
        return $this->hasMany('App\Projet');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['annee', 'active'];

    public function agences()
    {
        return $this->hasMany('App\Agence');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['nom', 'agence_id', 'projet_id', 'titre', 'extension', 'name'];

    public function agence()
    {
        return $this->belongsTo('App/Agence');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class devis_taches extends Model
{
    protected $fillable = ['libelle', 'prix', 'projet_id', 'devis_id'];
}

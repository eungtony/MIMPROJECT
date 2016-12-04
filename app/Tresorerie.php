<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tresorerie extends Model
{
    protected $fillable = ['libelle', 'montant', 'user_id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TacheCommentaire extends Model
{
    protected $fillable = ['user_id', 'commentaire', 'travail_id', 'agence_id', 'projet_id'];
}

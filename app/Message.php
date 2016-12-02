<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['titre', 'message', 'agence_id', 'user_id'];
}

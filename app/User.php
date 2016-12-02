<?php

namespace App;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'agence_id', 'poste_id', 'statut_id', 'extension', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function agence()
    {
        return $this->belongsTo('App\Agence');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function poste()
    {
        return $this->belongsTo('App\Poste');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function tache()
    {
        return $this->hasMany('App\Travail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function statut()
    {
        return $this->belongsTo('App\Statut');
    }
}

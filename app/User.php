<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function kelompoks()
    {
        return $this->belongsToMany(Kelompok::class)
            ->withTimestamps();
    }

    public function getRolesListAttribute()
    {
        return $this->roles->pluck('id')->toArray();
    } 

    public function getKelompoksListAttribute()
    {
        return $this->kelompoks->pluck('id')->toArray();
    } 
}

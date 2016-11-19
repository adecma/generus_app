<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    public function gen()
    {
    	return $this->hasMany(Gen::class);
    }

    public function users()
    {
    	return $this->belongsToMany(User::class)
    		->withTimestamps();;
    }

    public function kategoris()
    {
    	return $this->belongsToMany(Kategori::class)
    		->withTimestamps();
    }

    public function getKategorisListAttribute()
    {
        return $this->kategoris->pluck('id')->toArray();
    } 
}

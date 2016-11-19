<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public function gen()
    {
    	return $this->hasMany(Gen::class);
    }

    public function kelompoks()
    {
    	return $this->belongsToMany(Kelompok::class)
    		->withTimestamps();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    public function jurnal()
    {
    	return $this->belongsTo('App\Jurnal');
    }
}

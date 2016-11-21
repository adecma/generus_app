<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Collective\Html\Eloquent\FormAccessible;
use Carbon\Carbon;

class Jurnal extends Model
{
	use FormAccessible;

    protected $dates = ['tg'];

    public function formTgAttribute($value)
    {
    	return Carbon::parse($value)->format('Y-m-d');
    }

    public function galeris()
    {
    	return $this->hasMany('App\Galeri');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}

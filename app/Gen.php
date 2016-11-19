<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;

class Gen extends Model
{
	use FormAccessible;

    protected $dates = ['tg_lahir'];

    public function kelompok()
    {
    	return $this->belongsTo(Kelompok::class);
    }

    public function kategori()
    {
    	return $this->belongsTo(Kategori::class);
    }

    public function formTgLahirAttribute($value)
    {
    	return Carbon::parse($value)->format('Y-m-d');
    }
}

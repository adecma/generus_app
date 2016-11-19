<?php

namespace App;

use Laratrust\LaratrustRole;

class Role extends LaratrustRole
{
    public function getPermissionsListAttribute()
    {
    	return $this->permissions->pluck('id')->toArray();
    } 
}

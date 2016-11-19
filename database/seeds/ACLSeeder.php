<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;
use App\Kelompok;

class ACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sampelRole = [
        	[
        		'name' => 'master',
        		'display_name' => 'Role Super Admin',
        		'description' => 'Role only for adecma'
        	],
        	[
        		'name' => 'kelompok',
        		'display_name' => 'Role Admin Kelompok',
        		'description' => 'For user/kelompok'
        	],
        	[
        		'name' => 'viewer',
        		'display_name' => 'Monitoring Only',
        		'description' => 'For user desa, only read access data'
        	],
        ];

        $sampelPermission = [
        	[
        		'name' => 'manage-generus',
        		'display_name' => 'Manage Generus',
        		'description' => 'crud generus'
        	],
        	[
        		'name' => 'read-generus',
        		'display_name' => 'Read Generus',
        		'description' => 'read only'
        	],
        ];

        foreach ($sampelPermission as $perm) {
        	$sampel = new Permission;
        	$sampel->name = $perm['name'];
        	$sampel->display_name = $perm['display_name'];
        	$sampel->description = $perm['description'];
        	$sampel->save();
        }

        foreach ($sampelRole as $role) {
        	$sampel = new Role;
        	$sampel->name = $role['name'];
        	$sampel->display_name = $role['display_name'];
        	$sampel->description = $role['description'];
        	$sampel->save();

        	if ($sampel->name == 'master' || $sampel->name == 'kelompok') {
        		$sampel->permissions()->attach(1);
        	}
        }

        $kelompoks = Kelompok::all();

        $user = new User;
        $user->name = 'Ade Prast';
        $user->email = 'adecma18@gmail.com';
        $user->password = bcrypt('password354');
        $user->save();

        $user->kelompoks()->attach($kelompoks);

        $master = Role::find(1);

        $user->roles()->attach($master);

    }
}

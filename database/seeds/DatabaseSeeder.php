<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(KelompokSeeder::class);
         $this->call(KategoriSeeder::class);
         //$this->call(GenSeeder::class);
         //$this->call(LaratrustSeeder::class);
         $this->call(ACLSeeder::class);
    }
}

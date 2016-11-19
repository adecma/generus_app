<?php

use Illuminate\Database\Seeder;

use App\Kelompok;

class KelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sampelData = [
        	[
        		'nama' => 'Bati Bati',
        		'alamat' => ''
        	],
        	[
        		'nama' => 'Cindai Alus',
        		'alamat' => ''
        	],
        	[
        		'nama' => 'Palm',
        		'alamat' => ''
        	],
        	[
        		'nama' => 'Pondok Empat',
        		'alamat' => ''
        	],
        	[
        		'nama' => 'Sidomulyo',
        		'alamat' => ''
        	],
        	[
        		'nama' => 'Ulin Kota',
        		'alamat' => ''
        	],
        ];

        foreach ($sampelData as $data) {
        	$sampel = new Kelompok;
        	$sampel->nama = $data['nama'];
        	$sampel->save();
        }
    }
}

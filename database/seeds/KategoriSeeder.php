<?php

use Illuminate\Database\Seeder;

use App\Kategori;

class KategoriSeeder extends Seeder
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
        		'nama' => 'Caberawit',
        		'keterangan' => 'Usia PAUD - SD'
        	],
        	[
        		'nama' => 'Praremaja',
        		'keterangan' => 'Usia SMP'
        	],
        	[
        		'nama' => 'Remaja',
        		'keterangan' => 'Usia SMA'
        	],
        	[
        		'nama' => 'Cendikiawan',
        		'keterangan' => 'Usia Pekerja/Mahasiswa/Umum (belum nikah)'
        	],
        ];

        foreach ($sampelData as $data) {
        	$sampel = new Kategori;
        	$sampel->nama = $data['nama'];
        	$sampel->keterangan = $data['keterangan'];
        	$sampel->save();
        }
    }
}

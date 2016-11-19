<?php

use Illuminate\Database\Seeder;

class GenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) { 
            $sampel = new App\Gen;
            $sampel->nama_lengkap = 'Ade Prastiyo';
            $sampel->nama_pendek = 'Ade';
            $sampel->gender = 'Laki';
            $sampel->tg_lahir = '1993-11-18';
            $sampel->orang_tua = 'Suwarno';
            $sampel->alamat = 'Jl.Pondok Empat Gg.Krisna RT19 RW08, Kel. Loktabat Utara, Kec. Banjarbaru Utara, Banjarbaru';
            $sampel->kelompok_id = 4;
            $sampel->kategori_id = 4;
            $sampel->save();
        }

        for ($i=0; $i < 5; $i++) { 
            $sampel = new App\Gen;
            $sampel->nama_lengkap = 'Dwi Siswanto';
            $sampel->nama_pendek = 'Dwi';
            $sampel->gender = 'Laki';
            $sampel->tg_lahir = '1990-11-18';
            $sampel->orang_tua = 'Ngadiman';
            $sampel->alamat = 'Jl.Palm';
            $sampel->kelompok_id = 3;
            $sampel->kategori_id = 4;
            $sampel->save();
        }
        
        for ($i=0; $i < 5; $i++) { 
            $sampel = new App\Gen;
            $sampel->nama_lengkap = 'Rendy Ludyn';
            $sampel->nama_pendek = 'Rendy';
            $sampel->gender = 'Laki';
            $sampel->tg_lahir = '1994-11-18';
            $sampel->orang_tua = 'Sukardi';
            $sampel->alamat = 'Jl.Palm';
            $sampel->kelompok_id = 1;
            $sampel->kategori_id = 4;
            $sampel->save();
        }
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriKelompokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_kelompok', function (Blueprint $table) {
            $table->integer('kategori_id')->unsigned();
            $table->integer('kelompok_id')->unsigned();
            $table->timestamps();

            $table->primary(['kategori_id', 'kelompok_id']);

            $table->foreign('kategori_id')
                ->references('id')->on('kategoris')
                ->onDelete('cascade');
            $table->foreign('kelompok_id')
                ->references('id')->on('kelompoks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_kelompok');
    }
}

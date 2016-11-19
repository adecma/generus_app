<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_lengkap')->nullable();
            $table->string('nama_pendek');
            $table->enum('gender', ['Laki', 'Perempuan']);
            $table->date('tg_lahir')->nullable();
            $table->string('orang_tua')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('kelompok_id')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('gens');
    }
}

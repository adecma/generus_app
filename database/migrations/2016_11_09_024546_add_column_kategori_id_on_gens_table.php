<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnKategoriIdOnGensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gens', function (Blueprint $table) {
            $table->integer('kategori_id')->unsigned();

            $table->foreign('kategori_id')
                ->references('id')->on('kategoris')
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
        Schema::table('gens', function (Blueprint $table) {
            $table->dropForeign('gens_kategori_id_foreign');
            $table->dropColumn('kategori_id');
        });
    }
}

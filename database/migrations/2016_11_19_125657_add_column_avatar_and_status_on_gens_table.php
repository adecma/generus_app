<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAvatarAndStatusOnGensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gens', function (Blueprint $table) {
            $table->string('avatar')->default('no_avatar.png');
            $table->string('status')->nullable();
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
            $table->dropColumn('avatar');
            $table->dropColumn('status');
        });
    }
}

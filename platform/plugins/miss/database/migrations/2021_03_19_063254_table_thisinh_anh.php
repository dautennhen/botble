<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableThisinhAnh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thisinhs', function (Blueprint $table) {
            $table->string('anh_1', 255)->nullable();
            $table->string('anh_2', 255)->nullable();
            $table->string('anh_3', 255)->nullable();
            $table->string('anh_4', 255)->nullable();
            $table->string('anh_5', 255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thisinhs');
    }
}

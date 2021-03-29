<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MissCreateThachthucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thachthucs', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('id_thi_sinh')->index();
            $table->string('ten_team', 255)->nullable();
            $table->string('huan_luyen_vien', 255)->nullable();
            $table->integer('ts1')->nullable();
            $table->integer('ts2')->nullable();
            $table->integer('ts3')->nullable();
            $table->integer('ts4')->nullable();
            $table->integer('ts5')->nullable();
            $table->integer('ts6')->nullable();
            $table->integer('ts7')->nullable();
            $table->integer('ts8')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thachthucs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableThiSinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thisinhs', function (Blueprint $table) {
            $table->string('can_nang', 255)->nullable();
            $table->string('dia_chi', 255)->nullable();
            $table->string('khoa_nganh', 255)->nullable();
            $table->integer('sdt_nguoi_than')->nullable();
            $table->string('ho_ten_me', 255)->nullable();
            $table->string('ho_ten_cha', 255)->nullable();
            $table->string('avatar_toan_than_1', 255)->nullable();
            $table->string('avatar_toan_than_2', 255)->nullable();
            $table->string('ban_scan', 255)->nullable();
            $table->string('vong_loai', 255)->nullable();
            $table->string('vong_top_200', 255)->nullable();
            $table->string('vong_top_40', 255)->nullable();
            $table->string('vong_top_35', 255)->nullable();


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

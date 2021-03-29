<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MissCreateThisinhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thisinhs', function (Blueprint $table) {
            $table->id();
            $table->string('mssv', 255);
            $table->unsignedBigInteger('id_truong')->index();
            $table->unsignedBigInteger('id_nam_hoc')->index();
            $table->string('so_bao_danh',255);
            $table->string('ho', 255);
            $table->string('ten', 255);
            $table->string('full_name', 255)->nullable();
            $table->longText('mo_ta_ly_lich')->nullable();
            $table->integer('sdt');
            $table->string('email', 255);
            $table->string('avatar', 255);
            $table->string('video', 255)->nullable();
            $table->integer('tuoi');
            $table->string('chieu_cao', 60);
            $table->string('so_do_ba_vong', 255);
            $table->string('que_quan', 255);
            $table->date('ngay_sinh');
            $table->integer('luot_xem_profile')->default('0');
            $table->integer('luot_bau_chon')->default('0');
            $table->integer('luot_chia_se_fb')->default('0');
            $table->integer('luot_chia_se_khac')->default('0');
            $table->softDeletes('deleted_at', 0)->nullable();
            $table->string('who', 255)->nullable();
            $table->string('ip_address', 255)->nullable();
            $table->string('device', 255)->nullable();
            $table->string('vong_1', 60)->default('enable');
            $table->string('vong_2', 60)->default('enable');
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
        Schema::dropIfExists('thisinhs');
    }
}

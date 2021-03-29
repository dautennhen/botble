<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MissCreatePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_thi_sinh')->index();
            $table->longText('mo_ta')->nullable();
            $table->integer('sap_xep')->nullable();
            $table->softDeletes('deleted_at', 0)->nullable();
            $table->string('who', 255)->nullable();
            $table->string('ip_address', 255)->nullable();
            $table->string('device', 255)->nullable();
            $table->string('image', 255)->nullable();
            // $table->string('status', 60)->default('published');
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
        Schema::dropIfExists('photos');
    }
}

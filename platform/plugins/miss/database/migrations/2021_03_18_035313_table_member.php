<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('facebook', 255)->nullable();
            $table->string('google', 255)->nullable();
            $table->softDeletes('deleted_at', 0)->nullable();
            $table->string('who', 255)->nullable();
            $table->string('ip_address', 255)->nullable();
            $table->string('device', 255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}

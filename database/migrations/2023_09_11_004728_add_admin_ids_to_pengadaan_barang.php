<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminIdsToPengadaanBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengadaan_barang', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_tim_id')->nullable();
            $table->unsignedBigInteger('admin_general_id')->nullable();

            $table->foreign('admin_tim_id')->references('id')->on('users');
            $table->foreign('admin_general_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengadaan_barang', function (Blueprint $table) {
            //
        });
    }
}

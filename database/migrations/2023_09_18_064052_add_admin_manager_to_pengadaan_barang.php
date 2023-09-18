<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminManagerToPengadaanBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::table('pengadaan_barang', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_manager_id')->nullable();


            $table->foreign('admin_manager_id')->references('id')->on('users');
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

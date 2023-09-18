<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlasanPengadaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alasan_pengadaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengadaan_barang_id');
            $table->unsignedBigInteger('admin_id');
            $table->text('alasan');
            $table->enum('status', ['setuju', 'tolak']);
            $table->timestamps();

            $table->foreign('pengadaan_barang_id')->references('id')->on('pengadaan_barang');
            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alasan_pengadaans');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->string('no_nota', 10)->primary(); // Primary Key
            $table->date('tgl_nota');
            $table->string('keterangan', 15);
            $table->string('pembayaran', 30);
            $table->integer('total');
            $table->integer('bayar');
            $table->integer('kembali');
            $table->unsignedBigInteger('id_pelanggan'); // Foreign Key
            $table->unsignedBigInteger('id_user'); // Foreign Key
            $table->timestamps();

            // Definisikan foreign key
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
            $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};

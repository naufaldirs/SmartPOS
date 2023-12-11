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
            $table->string('no_nota')->primary(); // Primary Key
            $table->date('tgl_nota');
            $table->string('pembayaran');
            $table->integer('total')->nullable()->default(NULL);
            $table->integer('bayar')->nullable()->default(NULL);
            $table->integer('kembali')->nullable()->default(NULL);
            $table->unsignedBigInteger('id_pelanggan'); // Foreign Key
            $table->unsignedBigInteger('id_user'); // Foreign Key
            $table->timestamps();

            // Definisikan foreign key
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
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

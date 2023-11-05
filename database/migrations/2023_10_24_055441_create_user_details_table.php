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
        Schema::create('user_detail', function (Blueprint $table) {
            $table->id('id_user'); // Foreign Key
            $table->string('nama', 35);
            $table->date('tgl_lahir');
            $table->string('alamat', 150);
            $table->string('no_telp', 15);
            $table->string('email', 35);
            $table->string('foto', 255);
            $table->timestamps();
            
            
            // Definisikan foreign key
            $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_detail');
    }
};

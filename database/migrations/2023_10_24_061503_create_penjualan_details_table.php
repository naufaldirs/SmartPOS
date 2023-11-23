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
        Schema::create('penjualan_detail', function (Blueprint $table) {
            $table->integer('qty');
            $table->integer('subtotal');
            $table->string('no_nota');
            $table->string('kd_sparepart');
            $table->timestamps();


            //foreign key
            $table->foreign('no_nota')->references('no_nota')->on('penjualan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kd_sparepart')->references('kd_sparepart')->on('sparepart')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_detail');
    }
};

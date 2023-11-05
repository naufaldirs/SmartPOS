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
            $table->string('no_nota', 10);
            $table->string('kd_sparepart', 7);
            $table->integer('qty');
            $table->integer('subtotal');
            $table->timestamps();


            //foreign key
            $table->foreign('no_nota')->references('no_nota')->on('penjualan');
            $table->foreign('kd_sparepart')->references('kd_sparepart')->on('sparepart');
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

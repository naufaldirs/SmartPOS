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
        Schema::create('forecast_results', function (Blueprint $table) {
            $table->id('no');
            $table->string('kd_sparepart');
            $table->date('periode');
            $table->double('actual');
            $table->double('forecast');
            $table->double('mad');
            $table->double('mse');
            $table->double('mape');
            $table->double('trend')->nullable();
            $table->timestamps();

            $table->foreign('kd_sparepart')->references('kd_sparepart')->on('sparepart')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecast_results');
    }
};

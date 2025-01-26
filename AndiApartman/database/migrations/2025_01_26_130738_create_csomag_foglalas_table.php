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
        Schema::create('csomag_foglalas', function (Blueprint $table) {
            $table->unsignedBigInteger('csomag_id');
            $table->unsignedBigInteger('foglalas_id');
            $table->foreign('csomag_id')->references('csomag_id')->on('erkezesi_csomagok')->onDelete('cascade');
            $table->foreign('foglalas_id')->references('foglalas_id')->on('foglalasok')->onDelete('cascade');
            $table->primary(['csomag_id', 'foglalas_id']);
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('csomag_foglalas');
    }
};

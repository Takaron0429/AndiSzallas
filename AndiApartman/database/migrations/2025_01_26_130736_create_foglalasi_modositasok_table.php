<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('foglalasi_modositasok', function (Blueprint $table) {
            $table->id('modositas_id');
            $table->unsignedBigInteger('foglalas_id');
            $table->foreign('foglalas_id')->references('foglalas_id')->on('foglalasok')->onDelete('cascade'); 
            $table->string('modositas_tipusa', 50);
            $table->timestamp('kerestet_datuma')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('allapot', 50)->default('függőben');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('foglalasi_modositasok');
    }
};

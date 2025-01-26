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
        Schema::create('fizetesek', function (Blueprint $table) {
            $table->id('fizetes_id');
            
    
            $table->unsignedBigInteger('foglalas_id');

            $table->foreign('foglalas_id')->references('foglalas_id')->on('foglalasok')->onDelete('cascade');
            
            $table->decimal('osszeg');
            $table->string('fizetesi_mod');
            $table->string('fizetesi_allapot')->default('függőben');
            $table->timestamp('tranzakcio_datuma')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('fizetesek');
    }
};

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
        Schema::create('foglalasok', function (Blueprint $table) {
            $table->id('foglalas_id'); 
            $table->unsignedBigInteger('vendeg_id');
            $table->date('erkezes');
            $table->date('tavozas');
            $table->decimal('osszeg');
            $table->string('foglalas_allapot')->default('függőben');
            $table->string('fizetes_allapot')->default('függőben');
            $table->text('speciális_keresek')->nullable();
            $table->unsignedBigInteger('csomag_id')->nullable();
            $table->unsignedBigInteger('akcio_id')->nullable();
            $table->foreign('vendeg_id')->references('vendeg_id')->on('vendeg')->onDelete('cascade');
            $table->foreign('csomag_id')->references('csomag_id')->on('erkezesi_csomagok')->onDelete('set null');
            $table->foreign('akcio_id')->references('akcio_id')->on('akciok')->onDelete('set null'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foglalasok');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('foglalasok', function (Blueprint $table) {
            $table->id('foglalas_id');
            $table->unsignedBigInteger('vendeg_id')->nullable(); // Nem kötelező
            $table->date('erkezes');
            $table->date('tavozas');
            $table->integer('felnott');
            $table->integer('gyerek');
            $table->decimal('osszeg', 8, 2);
            $table->string('foglalas_allapot')->default('függőben');
            $table->string('fizetes_allapot')->default('függőben');
            $table->text('speciális_keresek')->nullable(); // Nem kötelező
            $table->unsignedBigInteger('csomag_id')->nullable(); // Nem kötelező
            $table->unsignedBigInteger('akcio_id')->nullable(); // Nem kötelező
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

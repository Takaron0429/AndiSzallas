<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('foglalasok', function (Blueprint $table) {
            $table->id('foglalas_id');
            $table->unsignedBigInteger('vendeg_id')->nullable();
            $table->date('erkezes');
            $table->date('tavozas');
            $table->integer('felnott');
            $table->integer('gyerek');
            $table->decimal('osszeg', 8, 2);
            $table->string('foglalas_allapot')->default('függőben');
            $table->string('fizetes_allapot')->default('függőben');
            $table->text('specialis_keresek')->nullable();
            $table->unsignedBigInteger('csomag_id')->nullable();
            $table->unsignedBigInteger('akcio_id')->nullable();
            $table->timestamps();

            $table->foreign('vendeg_id')->references('vendeg_id')->on('vendeg')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('foglalasok');
    }
};

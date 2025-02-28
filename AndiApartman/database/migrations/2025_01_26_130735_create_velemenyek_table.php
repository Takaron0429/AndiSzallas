<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('velemenyek', function (Blueprint $table) {
            $table->id('velemeny_id');
            $table->unsignedBigInteger('vendeg_id');
            $table->foreign('vendeg_id')->references('vendeg_id')->on('vendeg')->onDelete('cascade');
            $table->integer('ertekeles')->check('ertekeles >= 1 AND ertekeles <= 10');
            $table->text('komment')->nullable();
            $table->timestamps();
        });
    }
    

    public function down(): void
    {
        Schema::dropIfExists('velemenyek');
    }
};

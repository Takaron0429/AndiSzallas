<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('vendeg', function (Blueprint $table) {
            $table->id('vendeg_id'); 
            $table->string('nev');
            $table->string('email');
            $table->string('telefon')->nullable();
            $table->string('iranyitoszam')->nullable();
            $table->string('lakcim')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendeg');
    }
};

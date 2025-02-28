<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('erkezesi_csomagok', function (Blueprint $table) {
            $table->id('csomag_id');
            $table->string('nev');
            $table->text('leiras')->nullable();
            $table->decimal('ar');
            $table->boolean('elerheto')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('erkezesi_csomagok');
    }
};

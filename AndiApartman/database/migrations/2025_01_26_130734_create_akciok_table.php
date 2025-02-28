<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('akciok', function (Blueprint $table) {
            $table->id('akcio_id');
            $table->string('cim');
            $table->text('leiras')->nullable();
            $table->decimal('kedvezmeny_szazalek');
            $table->date('kezdete');
            $table->date('vege');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akciok');
    }
};

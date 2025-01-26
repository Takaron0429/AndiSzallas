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
        Schema::create('akcio_foglalas', function (Blueprint $table) {
            $table->unsignedBigInteger('akcio_id');
            $table->unsignedBigInteger('foglalas_id');
            $table->foreign('akcio_id')->references('akcio_id')->on('akciok')->onDelete('cascade');
            $table->foreign('foglalas_id')->references('foglalas_id')->on('foglalasok')->onDelete('cascade');
            $table->primary(['akcio_id', 'foglalas_id']);
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('akcio_foglalas');
    }
};

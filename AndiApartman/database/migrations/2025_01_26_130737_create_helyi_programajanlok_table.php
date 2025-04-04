<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   //run
    public function up(): void
    {
        Schema::create('helyi_programajanlok', function (Blueprint $table) {
            $table->id('program_id');
            $table->string('cim');
            $table->string('kep');
            $table->text('leiras')->nullable();
            $table->string('helyszin');
            $table->string("kezdet");
            $table->string("vege");
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('helyi_programajanlok');
    }
};

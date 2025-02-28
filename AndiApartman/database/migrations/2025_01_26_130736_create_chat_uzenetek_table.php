<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('chat_uzenetek', function (Blueprint $table) {
            $table->id('chat_id');
            
            $table->unsignedBigInteger('vendeg_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            
            $table->foreign('vendeg_id')->references('vendeg_id')->on('vendeg')->onDelete('set null');
            $table->foreign('admin_id')->references('admin_id')->on('admin')->onDelete('set null');
            
            $table->text('uzenet');
            $table->timestamp('kuldes_datuma')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('kuldo', ['vendeg', 'admin']);
            
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('chat_uzenetek');
    }
};

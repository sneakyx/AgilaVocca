<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vocabulary_id')->constrained()->onDelete('cascade');
            $table->string('translation');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('translations');
    }
};
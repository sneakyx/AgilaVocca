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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('native_language_id')->constrained('languages');
            $table->foreignId('foreign_language_id')->constrained('languages');
            $table->timestamps();
        });
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('book_id')->constrained();
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->id();
            $table->string('native');
            $table->string('foreign');
            $table->foreignId('chapter_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabularies');
        Schema::dropIfExists('chapters');
        Schema::dropIfExists('books');
        Schema::dropIfExists('languages');
    }
};

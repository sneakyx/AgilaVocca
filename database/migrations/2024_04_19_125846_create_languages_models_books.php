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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('book_id')->constrained();
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('language_book_native', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained();
            $table->foreignId('book_id')->constrained();
            $table->timestamps();
        });
        Schema::create('language_book_foreign', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained();
            $table->foreignId('book_id')->constrained();
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
        Schema::dropIfExists('language_book_foreign');
        Schema::dropIfExists('language_book_native');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('vocabularies');
        Schema::dropIfExists('chapters');
        Schema::dropIfExists('books');
    }
};

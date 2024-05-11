<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 *
 */
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('standard_book_id')->nullable();

                $table->foreign('standard_book_id')
                    ->references('id')
                    ->on('books')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['standard_book_id']);
            $table->dropColumn('standard_book_id');
        });
    }
};

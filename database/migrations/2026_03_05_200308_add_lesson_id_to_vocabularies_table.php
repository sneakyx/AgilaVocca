<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('vocabularies', function (Blueprint $table) {
            $table->foreignId('lesson_id')->nullable()->after('chapter_id')->constrained()->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('vocabularies', function (Blueprint $table) {
            $table->dropForeign(['lesson_id']);
            $table->dropColumn('lesson_id');
        });
    }
};
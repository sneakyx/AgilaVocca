<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name')->nullable();
        });

        // Standardsprachen mit Slugs ergänzen (nur wenn nicht vorhanden)
        $languages = [
            ['name' => 'Deutsch', 'slug' => 'de'],
            ['name' => 'Englisch', 'slug' => 'en'],
            ['name' => 'Französisch', 'slug' => 'fr'],
        ];

        foreach ($languages as $language) {
            DB::table('languages')
                ->where('name', $language['name'])
                ->whereNull('slug')
                ->update(['slug' => $language['slug']]);

            // Falls die Sprache noch nicht existiert, einfügen
            if (DB::table('languages')->where('name', $language['name'])->doesntExist()) {
                DB::table('languages')->insert($language);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
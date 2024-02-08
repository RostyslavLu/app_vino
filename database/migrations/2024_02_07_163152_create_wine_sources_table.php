<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wine_sources', function (Blueprint $table) {
            $table->id();
            $table->string('source', 20);
            $table->timestamps();
        });
        DB::table('wine_sources')->insert([
            ['source' => 'saq_wines'],
            ['source' => 'personal_wines']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wine_sources');
    }
};

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
        Schema::create('cellar_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->date('purchase_date');
            $table->date('revoke_date')->nullable();
            $table->year('vintage')->nullable();
            $table->varchar('notes', 100)->nullable();
            $table->integer('cellars_id');
            $table->integer('saq_wines_id')->nullable();
            $table->integer('personal_wines_id')->nullable();
            $table->integer('wine_sources_id');
            $table->timestamps();
        });
        Schema::table('cellar_contents', function (Blueprint $table) {
            $table->foreign('cellars_id')->references('id')->on('cellars');
            $table->foreign('saq_wines_id')->references('id')->on('saq_wines');
            $table->foreign('personal_wines_id')->references('id')->on('personal_wines');
            $table->foreign('wine_sources_id')->references('id')->on('wine_sources');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cellar_contents');
    }
};

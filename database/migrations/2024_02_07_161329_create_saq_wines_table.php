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
        Schema::create('saq_wines', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('code_wine', 50)->unique()->nullable();
            $table->string('url', 200);
            $table->string('url_image', 200);
            $table->text('description', 1000)->nullable();
            $table->double('price');
            $table->string('format', 50)->nullable();
            $table->text('regulated_designation', 500)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('region', 100)->nullable();
            $table->string('grape_varieties', 100)->nullable();
            $table->string('degree_alcohol', 50)->nullable();
            $table->string('sugar_content', 50)->nullable();
            $table->integer('types_id');
            $table->timestamps();
        });
        Schema::table('saq_wines', function (Blueprint $table) {
            $table->foreign('types_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saq_wines');
    }
};

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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // Multilingual title
            $table->json('description'); // Multilingual description
            $table->string('image'); // Project image
            $table->string('company_name'); // Company name
            $table->string('company_website')->nullable(); // Company website
            $table->string('project_link')->nullable(); // Project link
            $table->integer('order')->default(0); // Order for sorting
            $table->boolean('status')->default(true); // Status (active/inactive)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};

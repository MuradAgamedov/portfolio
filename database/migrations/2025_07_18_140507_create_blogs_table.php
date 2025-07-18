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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            
            // Multilingual fields
            $table->json('title'); // Başlıq
            $table->json('slug'); // URL slug
            $table->json('card_image_alt_text'); // Card şəkli alt mətni
            $table->json('main_description'); // Əsas təsvir
            $table->json('inner_description'); // Daxili təsvir
            
            // SEO fields
            $table->json('seo_title'); // SEO başlıq
            $table->json('seo_keywords'); // SEO açar sözlər
            $table->json('seo_description'); // SEO təsvir
            
            // Media fields
            $table->string('card_image')->nullable(); // Card şəkli
            $table->string('main_image')->nullable(); // Əsas şəkil
            
            // Status and date fields
            $table->boolean('status')->default(true); // Aktiv/Deaktiv
            $table->timestamp('published_at')->nullable(); // Nəşr tarixi
            
            // Order and timestamps
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('slug')->change();
            $table->json('card_image_alt_text')->change();
            $table->json('main_description')->change();
            $table->json('seo_title')->change();
            $table->json('seo_keywords')->change();
            $table->json('seo_description')->change();

            $table->json('main_image_alt_text')->nullable()->after('card_image_alt_text');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('slug')->change();
            $table->text('card_image_alt_text')->change();
            $table->longText('main_description')->change();
            $table->text('seo_title')->change();
            $table->text('seo_keywords')->change();
            $table->text('seo_description')->change();

            $table->dropColumn('main_image_alt_text');
        });
    }
};

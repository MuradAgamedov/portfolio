<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->text('seo_description')->nullable()->change();
            $table->text('seo_keywords')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->text('seo_description')->nullable(false)->change();
            $table->text('seo_keywords')->nullable(false)->change();
        });
    }
};

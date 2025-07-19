<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('education', function (Blueprint $table) {
            $table->text('university_name')->change();
        });
    }

    public function down(): void
    {
        Schema::table('education', function (Blueprint $table) {
            $table->string('university_name', 255)->change();
        });
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('education', function (Blueprint $table) {
            $table->text('university_name')->nullable()->after('id'); // 'id' yerinə istədiyin sahənin adını yaza bilərsən
        });
    }

    public function down(): void
    {
        Schema::table('education', function (Blueprint $table) {
            $table->dropColumn('university_name');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Wizard progress
            $table->unsignedTinyInteger('current_step')->nullable()->after('is_active');

            // Submission lock
            $table->string('status')->default('draft')->after('current_step');
            $table->timestamp('submitted_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['current_step', 'status', 'submitted_at']);
        });
    }
};

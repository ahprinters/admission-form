<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_category_flags', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->boolean('is_working')->default(false);                 // কর্মজীবী
            $table->boolean('is_landless')->default(false);                // ভূমিহীন
            $table->boolean('is_foster')->default(false);                  // পোষ্য
            $table->boolean('is_freedom_fighter_child')->default(false);   // মুক্তিযোদ্ধা পোষ্য
            $table->boolean('is_disabled')->default(false);                // প্রতিবন্ধী
            $table->boolean('is_orphan')->default(false);                  // এতিম
            $table->boolean('is_indigenous')->default(false);              // উপজাতি
            $table->boolean('is_none')->default(false);                    // কোনটিই নয়

            $table->timestamps();

            $table->unique('student_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_category_flags');
    }
};

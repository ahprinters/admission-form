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
        Schema::table('student_classes', function (Blueprint $table) {

            // Student linkage
            if (!Schema::hasColumn('student_classes', 'student_id')) {
                $table->foreignId('student_id')
                      ->after('id')
                      ->constrained('students')
                      ->cascadeOnDelete();
            }

            // Grade (already exists but keep safe)
            if (!Schema::hasColumn('student_classes', 'grade_id')) {
                $table->foreignId('grade_id')
                      ->constrained('grades')
                      ->restrictOnDelete();
            }

            // Stream (nullable for junior classes)
            if (!Schema::hasColumn('student_classes', 'stream_id')) {
                $table->foreignId('stream_id')
                      ->nullable()
                      ->constrained('streams')
                      ->nullOnDelete();
            }

            // Teacher (optional class teacher)
            if (!Schema::hasColumn('student_classes', 'teacher_id')) {
                $table->foreignId('teacher_id')
                      ->nullable()
                      ->constrained('teachers')
                      ->nullOnDelete();
            }

            // Academic year (replacing weak `year` column)
            if (!Schema::hasColumn('student_classes', 'academic_year_id')) {
                $table->foreignId('academic_year_id')
                      ->constrained('academic_years')
                      ->restrictOnDelete();
            }

            // Current class indicator
            if (!Schema::hasColumn('student_classes', 'is_current')) {
                $table->boolean('is_current')->default(true);
            }

            // Remove old weak year column if exists
            if (Schema::hasColumn('student_classes', 'year')) {
                $table->dropColumn('year');
            }


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_classes', function (Blueprint $table) {

            if (Schema::hasColumn('student_classes', 'student_id')) {
                $table->dropForeign(['student_id']);
                $table->dropColumn('student_id');
            }

            if (Schema::hasColumn('student_classes', 'academic_year_id')) {
                $table->dropForeign(['academic_year_id']);
                $table->dropColumn('academic_year_id');
            }

            if (Schema::hasColumn('student_classes', 'stream_id')) {
                $table->dropForeign(['stream_id']);
                $table->dropColumn('stream_id');
            }

            if (Schema::hasColumn('student_classes', 'teacher_id')) {
                $table->dropForeign(['teacher_id']);
                $table->dropColumn('teacher_id');
            }

            if (Schema::hasColumn('student_classes', 'is_current')) {
                $table->dropColumn('is_current');
            }

            // rollback support
            $table->year('year')->nullable();
        });
    }
};

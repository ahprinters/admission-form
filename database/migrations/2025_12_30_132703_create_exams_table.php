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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();

            $table->string('exam_name');
            $table->date('start_date');
            $table->date('end_date');

            $table->foreignId('semester_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('student_class_id')
                ->constrained('student_classes')
                ->cascadeOnDelete();

            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('session_id')
                ->constrained('academic_sessions')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};

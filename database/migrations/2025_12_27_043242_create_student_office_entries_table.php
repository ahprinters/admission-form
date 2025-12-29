<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_office_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();

            $table->string('class_teacher_name')->nullable();
            $table->string('class_teacher_signature_path')->nullable();

            $table->string('accountant_name')->nullable();
            $table->string('accountant_signature_path')->nullable();

            $table->decimal('session_fee', 10, 2)->nullable();   // fees table থেকে
            $table->decimal('admission_fee', 10, 2)->nullable(); // fees table থেকে
            $table->decimal('monthly_fee_jan', 10, 2)->nullable();
            $table->decimal('misc_fee', 10, 2)->nullable();

            $table->text('principal_comment')->nullable();
            $table->string('principal_signature_path')->nullable();

            $table->timestamps();
            $table->unique('student_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_office_entries');
    }
};

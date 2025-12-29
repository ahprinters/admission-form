<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_admission_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();

            $table->string('generated_pdf_path')->nullable();
            $table->string('signed_pdf_path')->nullable();

            $table->timestamps();
            $table->unique('student_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_admission_forms');
    }
};

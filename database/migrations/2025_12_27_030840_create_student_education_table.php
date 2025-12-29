<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_educations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->string('institution_name')->nullable();
            $table->string('class_name')->nullable();     // আপনি চাইলে class/grade নাম অন্যভাবে রাখতে পারেন
            $table->unsignedSmallInteger('pass_year')->nullable();
            $table->string('gpa')->nullable();            // GPA অনেকসময় 5.00, A+, etc—তাই string safe
            $table->string('transfer_certificate_no')->nullable(); // ছাড়পত্র নম্বর
            $table->date('transfer_certificate_date')->nullable();

            $table->unsignedSmallInteger('sort_order')->default(1);

            $table->timestamps();

            $table->index(['student_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_educations');
    }
};

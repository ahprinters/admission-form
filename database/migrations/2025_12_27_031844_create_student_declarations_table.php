<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_declarations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();

            $table->text('student_commitment')->nullable();
            $table->text('guardian_declaration')->nullable();

            // signature images (stored path)
            $table->string('student_signature_path')->nullable();
            $table->string('guardian_signature_path')->nullable();

            $table->timestamps();
            $table->unique('student_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_declarations');
    }
};

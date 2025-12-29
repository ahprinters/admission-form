<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_guardians', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->string('father_name_en')->nullable();
            $table->string('father_name_bn')->nullable();
            $table->string('father_mobile', 20)->nullable();

            $table->string('mother_name_en')->nullable();
            $table->string('mother_name_bn')->nullable();
            $table->string('mother_mobile', 20)->nullable();

            // বাবা/মা মৃত হলে অভিভাবক
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->string('guardian_mobile', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();

            // পেশা (একটি সিলেক্ট)
            $table->string('occupation')->nullable(); // agriculture, worker, business, ...
            $table->decimal('annual_income', 12, 2)->nullable();

            $table->string('land_amount')->nullable();
            $table->unsignedTinyInteger('family_members')->nullable();

            $table->text('permanent_address')->nullable();
            $table->text('present_address')->nullable();
            $table->unsignedTinyInteger('children_in_madrasa')->nullable();

            $table->timestamps();

            // one student => one guardian record
            $table->unique('student_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_guardians');
    }
};

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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_bn')->nullable();
            $table->string('email')->unique();
            $table->string('class');
            $table->string('roll_number');
            $table->enum('gender', ['male', 'female']);
            $table->string('phone');
            $table->date('date_of_birth')->nullable();
            $table->string('nid_birth_certificate')->nullable();
            $table->string('blood_group');
            $table->string('nationality')->default('Bangladeshi');
            $table->string('religion');
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->date('date');
            $table->boolean('status')->default(false); // true = present, false = absent
            $table->string('remarks')->nullable();
            // unique constraint (একই দিনে একই student এর একটাই attendance থাকবে)
            $table->unique(['student_id', 'date']);
            // index যোগ করা (query দ্রুত হবে)
            $table->index('date');
            $table->index('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

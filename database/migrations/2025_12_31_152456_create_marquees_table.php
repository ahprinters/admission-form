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
        Schema::create('marquees', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();        // optional label
            $table->text('message');                    // marquee text
            $table->boolean('status')->default(true);   // on/off
            $table->unsignedInteger('position')->default(0); // ordering
            $table->timestamp('starts_at')->nullable(); // optional schedule
            $table->timestamp('ends_at')->nullable();   // optional schedule
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marquees');
    }
};

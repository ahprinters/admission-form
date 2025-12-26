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
        // subject কলাম ইতিমধ্যেই নেই, তাই এখানে কিছু করার দরকার নেই
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // চাইলে subject কলাম আবার যোগ করতে পারো
            // $table->string('subject')->nullable();
        });
    }
};

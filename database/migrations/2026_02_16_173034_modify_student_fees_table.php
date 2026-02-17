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
        Schema::table('student_fees', function (Blueprint $table) {
            $table->dropcolumn(['is_paid', 'paid_at']);
            $table->decimal('paid_amount', 10, 2)->default(0)->after('total_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_fees', function (Blueprint $table) {
            $table->boolean('is_paid')->default(false);
            $table->timestamp('paid_at')->nullable;

            $table->dropColumn(['total_amount', 'paid_amount']);
        });
    }
};

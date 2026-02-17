<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('student_fees', function (Blueprint $table) {

        // rename amount → total_amount
        if (Schema::hasColumn('student_fees', 'amount')) {
            $table->renameColumn('amount', 'total_amount');
        }

        // add paid_amount if not exists
        if (!Schema::hasColumn('student_fees', 'paid_amount')) {
            $table->decimal('paid_amount', 10, 2)
                  ->default(0)
                  ->after('total_amount');
        }
    });
}

}

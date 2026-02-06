<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // example academic year
        $academicYearId = DB::table('academic_years')->value('id');

        if (!$academicYearId) {
            $this->command->warn('No academic year found. Seeder skipped.');
            return;
        }

        $students = DB::table('students')->pluck('id');

        foreach ($students as $studentId) {
            DB::table('student_classes')->insert([
                'student_id'        => $studentId,
                'grade_id'          => DB::table('grades')->inRandomOrder()->value('id'),
                'stream_id'         => DB::table('streams')->inRandomOrder()->value('id'),
                'teacher_id'        => DB::table('teachers')->inRandomOrder()->value('id'),
                'academic_year_id'  => $academicYearId,
                'is_current'        => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
        }

        $this->command->info('Student classes seeded successfully.');
    }
}

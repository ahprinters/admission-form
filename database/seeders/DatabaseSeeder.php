<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GradeSeeder::class,
            StreamSeeder::class,
            TeacherSeeder::class,
            StudentClassSeeder::class,
        ]);
    }
}

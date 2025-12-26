<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            ['name' => 'Grade 6'],
            ['name' => 'Grade 7'],
            ['name' => 'Grade 8'],
            ['name' => 'Grade 9'],
            ['name' => 'Grade 10'],
            ['name' => 'Grade 11'],
            ['name' => 'Grade 12'],
        ];

        Grade::upsert($grades, ['name']);
        $this->command->info('Grades seeded successfully!');
    }
}

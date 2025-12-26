<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentClass;
use App\Models\Grade;
use App\Models\Stream;
use App\Models\Teacher;

class StudentClassSeeder extends Seeder
{
    public function run(): void
    {
        if (Grade::count() === 0 || Stream::count() === 0 || Teacher::count() === 0) {
            $this->command->warn('Grades/Streams/Teachers missing — seed them first.');
            return;
        }

        $classes = [
            [
                'class_name' => 'A Section',
                'class_code' => 'CLS-101',
                'is_active'  => true,
                'grade_id'   => Grade::where('name', 'Grade 9')->value('id') ?? Grade::inRandomOrder()->value('id'),
                'stream_id'  => Stream::where('stream_name', 'Science')->value('id') ?? Stream::inRandomOrder()->value('id'),
                'teacher_id' => Teacher::inRandomOrder()->value('id'),
                'year'       => date('Y'),
            ],
            [
                'class_name' => 'B Section',
                'class_code' => 'CLS-102',
                'is_active'  => true,
                'grade_id'   => Grade::where('name', 'Grade 10')->value('id') ?? Grade::inRandomOrder()->value('id'),
                'stream_id'  => Stream::where('stream_name', 'Humanities')->value('id') ?? Stream::inRandomOrder()->value('id'),
                'teacher_id' => Teacher::inRandomOrder()->value('id'),
                'year'       => date('Y'),
            ],
        ];

        StudentClass::upsert($classes, ['class_code']);
        $this->command->info('Student classes seeded successfully!');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            ['name' => 'Md. Abdul Karim', 'email' => 'karim@example.com', 'phone' => '01712345678'],
            ['name' => 'Shamsun Nahar',   'email' => 'nahar@example.com', 'phone' => '01812345678'],
            ['name' => 'Rafiul Islam',    'email' => 'rafi@example.com',  'phone' => '01912345678'],
        ];

        Teacher::upsert($teachers, ['email']);
        $this->command->info('Teachers seeded successfully!');
    }
}

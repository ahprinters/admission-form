// database/factories/StudentClassFactory.php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Grade;
use App\Models\Stream;
use App\Models\Teacher;

class StudentClassFactory extends Factory
{
    public function definition(): array
    {
        return [
            'class_name' => $this->faker->unique()->randomElement(['A','B','C','D']) . ' Section',
            'class_code' => strtoupper($this->faker->bothify('CLS-###')),
            'is_active'  => true,
            'grade_id'   => Grade::inRandomOrder()->value('id'),
            'stream_id'  => Stream::inRandomOrder()->value('id'),
            'teacher_id' => Teacher::inRandomOrder()->value('id'),
            'year'       => $this->faker->numberBetween(date('Y')-1, date('Y')+1),
        ];
    }
}

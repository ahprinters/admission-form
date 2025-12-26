// database/factories/GradeFactory.php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Grade 1','Grade 2','Grade 3','Grade 4','Grade 5',
                'Grade 6','Grade 7','Grade 8','Grade 9','Grade 10','Grade 11','Grade 12',
            ]),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}

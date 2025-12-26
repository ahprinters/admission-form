// database/factories/StreamFactory.php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StreamFactory extends Factory
{
    public function definition(): array
    {
        return [
            'stream_name' => $this->faker->randomElement([
                'Science','Business Studies','Humanities'
            ]),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}

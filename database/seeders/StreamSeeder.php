<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stream;

class StreamSeeder extends Seeder
{
    public function run(): void
    {
        $streams = [
            ['stream_name' => 'Science',          'description' => null],
            ['stream_name' => 'Business Studies', 'description' => null],
            ['stream_name' => 'Humanities',       'description' => null],
        ];

        Stream::upsert($streams, ['stream_name']);
        $this->command->info('Streams seeded successfully!');
    }
}

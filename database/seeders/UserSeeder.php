<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'              => 'Admin User',
                'email'             => 'admin1@example.com',
                'email_verified_at' => Carbon::now(),
                'password'          => Hash::make('password123'), // login password
                'role'              => 'admin',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ]);

        $this->command->info('Default admin user created.');
    }
}

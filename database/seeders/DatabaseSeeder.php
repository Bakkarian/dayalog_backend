<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@dayalog.com',
            'phone_number' => '256700000000',
            'password' => Hash::make('password'),
        ]);
    }
}

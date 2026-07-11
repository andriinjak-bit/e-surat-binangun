<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'nik' => '1234567890123456',
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'), // password default
            'is_admin' => true,
        ]);
    }
}

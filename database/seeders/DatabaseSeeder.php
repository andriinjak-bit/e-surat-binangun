<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nik' => '1234567890123456',
            'password' => bcrypt('password'), // password default
            'is_admin' => true,
        ]);

        $this->call(PendudukSeeder::class);
    }
}

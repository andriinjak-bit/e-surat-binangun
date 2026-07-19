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
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'nik' => '1234567890123456',
                'name' => 'Admin User',
                'password' => bcrypt('password'), // password default
                'is_admin' => true,
            ]
            );
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'nik' => '1234567890123453',
                'name' => 'User',
                'password' => bcrypt('password'), // password default
                'is_admin' => false,
            ]
        );

        $this->call([
            PendudukSeeder::class,
            SuratTemplateSeeder::class,
        ]);
    }
}

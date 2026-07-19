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
        User::updateOrCreate(
            ['nik' => '1234567890123456'],
            [
                'password' => bcrypt('password'), // password default
                'is_admin' => true,
            ]
        );
        User::updateOrCreate(
            ['nik' => '1234567890123453'],
            [
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

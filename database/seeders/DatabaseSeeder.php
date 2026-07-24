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
            'nik' => '1123581321345589',
            'password' => bcrypt('admisibinangun2026'), // password default
            'is_admin' => true,
        ]);
        $this->call([
            SuratTemplateSeeder::class,
        ]);
    }
}

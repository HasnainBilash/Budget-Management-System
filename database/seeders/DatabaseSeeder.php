<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');

        if ($adminEmail && $adminPassword) {
            User::firstOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => env('ADMIN_NAME', 'Admin'),
                    'phone' => env('ADMIN_PHONE'),
                    'dob' => env('ADMIN_DOB', '1990-01-01'),
                    'password' => Hash::make($adminPassword),
                    'active' => true,
                    'role' => 'admin',
                ]
            );
        } else {
            $this->command?->warn('Skipping admin seed: set ADMIN_EMAIL and ADMIN_PASSWORD in .env to create the initial admin account.');
        }

        $this->call(DemoSeeder::class);
    }
}

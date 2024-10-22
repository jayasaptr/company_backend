<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Jaya Admin',
            'email' => 'jaya@gmail.com',
            'password' => Hash::make('password')
        ]);

        Company::create([
            'name' => 'Yayasan Hasnur Centre',
            'email' => 'yhc@hasnurcentre.org',
            'address' => 'JL. Jalan-Jalan',
            'latitude' => '-123.4567',
            'longitude' => '123.4567',
            'radius' => '0.5',
            'time_in' => '08:00',
            'time_out' => '17:00'
        ]);

        $this->call([
            AttendanceSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}

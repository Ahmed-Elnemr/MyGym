<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'ahmed',
            'email' => 'instructor@instructor.com',
            'role' => 'instructor',
            'password' => Hash::make('instructor')
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => Hash::make('Admin')

        ]);
        User::factory()->create([
            'name' => 'member',
            'email' => 'member@member.com',
            'role' => 'member',
            'password' => Hash::make('member')

        ]);

        User::factory()->count(10)->create();
        User::factory()->count(10)->create([
            'role' => 'instructor',
        ]);
    }
}

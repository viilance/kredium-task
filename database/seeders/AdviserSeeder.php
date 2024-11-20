<?php

namespace Database\Seeders;

use App\Models\Adviser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdviserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Adviser::create([
            'name' => 'First Adviser',
            'email' => 'first@example.com',
            'password' => Hash::make('password'),
        ]);

        Adviser::factory()->count(5)->create();
    }
}

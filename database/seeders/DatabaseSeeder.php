<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VinDataCounter;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        VinDataCounter::create([
            'start' => 2300000005,
            'end' => 500,
            'sn_total' => 2301105968,
        ]);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

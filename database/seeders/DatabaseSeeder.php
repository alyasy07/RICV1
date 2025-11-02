<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'tyraasmd@gmail.com',
        ]);

        // Seed Geran data
        $this->call([
            GeranPadananSeeder::class,
            GeranIndustriSeeder::class,
            PerundinganSeeder::class,
            KajianKesSeeder::class,
            MoaMouSeeder::class,
            PenerbitanPenulisanSeeder::class,
            GlobalAntarabangsaSeeder::class,
        ]);
    }
}

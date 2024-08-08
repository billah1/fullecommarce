<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Admin\AdminCredentialSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminCredentialSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(CurrencySeeder::class);
//        $this->call(CategorySeeder::class);
    }
}

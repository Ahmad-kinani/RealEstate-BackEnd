<?php

namespace Database\Seeders;

use App\Models\MethodPayment;
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
        $this->call([
            UserSeeder::class,
            CurrenciesSeeder::class,
            CurrencyFactorsSeeder::class,
            MethodPaymentSeeder::class,
        ]);
    }
}

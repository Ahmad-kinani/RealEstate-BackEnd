<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $currencies = [
            [
                'name' => 'Syrian Pound', 'code' => 'SP', 'symbol' => 'ل.س', 'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'US Dollar', 'code' => 'USD', 'symbol' => '$', 'is_active' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Euro', 'code' => 'EUR', 'symbol' => '€', 'is_active' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],


        ];

        foreach ($currencies as $currency) {
            $currency = Currency::firstOrCreate(
                ['name' => $currency['name']],
                $currency
            );
        }
    }
}
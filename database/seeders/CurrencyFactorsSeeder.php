<?php

namespace Database\Seeders;

use App\Models\CurrencyFactor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyFactorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currency_factors = [
            [
                'currency_id' => 1,
                "for_currency_id" => 1,
                'factor' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'currency_id' => 2,
                "for_currency_id" => 1,
                'factor' => 15000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'currency_id' => 3,
                "for_currency_id" => 1,
                'factor' => 16000,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($currency_factors as $currency_factor) {
            $currency_factor = CurrencyFactor::firstOrCreate(
                ['currency_id' => $currency_factor['currency_id'], 'for_currency_id' => $currency_factor['for_currency_id']],
                $currency_factor
            );
        }
    }
}
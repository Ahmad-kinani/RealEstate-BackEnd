<?php

namespace Database\Seeders;

use App\Models\MethodPayment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MethodPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $methods = [
            [
                'name' => 'Paypal',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bank Account',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cash',
                'created_at' => now(),
                'updated_at' => now()
            ],


        ];

        foreach ($methods as $method) {
            $method = MethodPayment::firstOrCreate(
                ['name' => $method['name']],
                $method
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            IncomeSeeder::class,
            OrderSeeder::class,
            SaleSeeder::class,
            StockSeeder::class,
        ]);
    }
}

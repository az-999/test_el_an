<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ru_RU');
        $rows = [];
        $now = Carbon::now();

        for ($i = 0; $i < 300; $i++) {
            $date = $now->copy()->subDays(random_int(0, 90));
            $rows[] = [
                'income_id' => 100000 + $i,
                'number' => (string) $faker->numerify('########'),
                'date' => $date->format('Y-m-d'),
                'last_change_date' => $date->format('Y-m-d'),
                'supplier_article' => strtoupper($faker->bothify('??-####')),
                'tech_size' => $faker->randomElement(['S', 'M', 'L', 'XL', '42', '44']),
                'barcode' => $faker->numberBetween(2000000000000, 2999999999999),
                'quantity' => $faker->numberBetween(1, 500),
                'total_price' => (string) $faker->numberBetween(1000, 500000),
                'date_close' => $faker->boolean(30) ? $date->copy()->addDays(3)->format('Y-m-d') : null,
                'warehouse_name' => $faker->randomElement(['Коледино', 'Подольск', 'Казань', 'Краснодар']),
                'nm_id' => $faker->numberBetween(10000000, 99999999),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('incomes')->insert($chunk);
        }
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ru_RU');
        $today = Carbon::today()->format('Y-m-d');
        $rows = [];

        for ($i = 0; $i < 200; $i++) {
            $rows[] = [
                'date' => $today,
                'last_change_date' => $today,
                'supplier_article' => strtoupper($faker->bothify('??-####')),
                'tech_size' => $faker->randomElement(['S', 'M', 'L']),
                'subject' => $faker->words(2, true),
                'category' => $faker->word(),
                'brand' => $faker->company(),
                'warehouse_name' => $faker->randomElement(['Коледино', 'Подольск', 'Казань']),
                'barcode' => $faker->numberBetween(2000000000000, 2999999999999),
                'quantity' => $faker->numberBetween(0, 200),
                'quantity_full' => $faker->numberBetween(0, 300),
                'in_way_to_client' => $faker->numberBetween(0, 20),
                'in_way_from_client' => $faker->numberBetween(0, 10),
                'nm_id' => $faker->numberBetween(10000000, 99999999),
                'sc_code' => $faker->numberBetween(100000, 999999),
                'is_supply' => $faker->boolean(),
                'is_realization' => $faker->boolean(),
                'price' => (string) $faker->numberBetween(500, 50000),
                'discount' => (string) $faker->numberBetween(0, 50),
            ];
        }

        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('stocks')->insert($chunk);
        }
    }
}

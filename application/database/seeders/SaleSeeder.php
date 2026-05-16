<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ru_RU');
        $incomeIds = DB::table('incomes')->pluck('income_id')->all();
        $rows = [];
        $now = Carbon::now();

        for ($i = 0; $i < 800; $i++) {
            $date = $now->copy()->subDays(random_int(0, 90));
            $rows[] = [
                'g_number' => $faker->uuid(),
                'date' => $date->format('Y-m-d'),
                'last_change_date' => $date->format('Y-m-d'),
                'supplier_article' => strtoupper($faker->bothify('??-####')),
                'tech_size' => $faker->randomElement(['S', 'M', 'L']),
                'barcode' => $faker->numberBetween(2000000000000, 2999999999999),
                'total_price' => (string) $faker->numberBetween(500, 50000),
                'discount_percent' => $faker->numberBetween(0, 50),
                'is_supply' => $faker->boolean(),
                'is_realization' => $faker->boolean(),
                'promo_code_discount' => $faker->boolean(20) ? (string) $faker->numberBetween(50, 500) : null,
                'warehouse_name' => $faker->randomElement(['Коледино', 'Подольск', 'Казань']),
                'country_name' => 'Россия',
                'oblast_okrug_name' => $faker->randomElement(['Центральный', 'Приволжский', 'Южный']),
                'region_name' => $faker->city(),
                'income_id' => (string) $faker->randomElement($incomeIds ?: [100001]),
                'sale_id' => (string) $faker->unique()->numberBetween(100000000, 999999999),
                'odid' => (string) $faker->numberBetween(100000000, 999999999),
                'spp' => (string) $faker->numberBetween(0, 30),
                'for_pay' => (string) $faker->numberBetween(400, 45000),
                'finished_price' => (string) $faker->numberBetween(400, 45000),
                'price_with_disc' => (string) $faker->numberBetween(400, 45000),
                'nm_id' => (string) $faker->numberBetween(10000000, 99999999),
                'subject' => $faker->words(2, true),
                'category' => $faker->word(),
                'brand' => $faker->company(),
                'is_storno' => $faker->boolean(5) ? '1' : '0',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('sales')->insert($chunk);
        }
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ru_RU');
        $incomeIds = DB::table('incomes')->pluck('income_id')->all();
        $rows = [];
        $now = Carbon::now();

        for ($i = 0; $i < 800; $i++) {
            $date = $now->copy()->subDays(random_int(0, 90))->setTime(
                random_int(0, 23),
                random_int(0, 59),
                random_int(0, 59)
            );
            $isCancel = $faker->boolean(15);
            $rows[] = [
                'g_number' => $faker->uuid(),
                'supplier_article' => strtoupper($faker->bothify('??-####')),
                'tech_size' => $faker->randomElement(['S', 'M', 'L', '42']),
                'warehouse_name' => $faker->randomElement(['Коледино', 'Подольск', 'Казань']),
                'oblast' => $faker->randomElement(['Московская', 'Татарстан', 'Краснодарский']),
                'odid' => (string) $faker->numberBetween(100000000, 999999999),
                'subject' => $faker->words(2, true),
                'category' => $faker->word(),
                'brand' => $faker->company(),
                'barcode' => $faker->numberBetween(2000000000000, 2999999999999),
                'income_id' => (string) $faker->randomElement($incomeIds ?: [100001]),
                'nm_id' => (string) $faker->numberBetween(10000000, 99999999),
                'total_price' => (string) $faker->numberBetween(500, 50000),
                'discount_percent' => $faker->numberBetween(0, 50),
                'date' => $date->format('Y-m-d H:i:s'),
                'last_change_date' => $date->format('Y-m-d'),
                'is_cancel' => $isCancel,
                'cancel_dt' => $isCancel ? $date->copy()->addHours(2)->format('Y-m-d H:i:s') : null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('orders')->insert($chunk);
        }
    }
}

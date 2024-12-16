<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class computersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Tạo 10 bản ghi dữ liệu giả
        foreach (range(1, 30) as $index) {
            DB::table('computers')->insert([
                'computer_name' => $faker->word(),
                'model' => $faker->word(),
                'operating_system' => $faker->word(),
                'processor' => $faker->word(),
                'memory' => $faker->numberBetween(4, 128),
                'available' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

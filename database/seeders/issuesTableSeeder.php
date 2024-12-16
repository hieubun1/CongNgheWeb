<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Issue;
use Illuminate\Support\Facades\DB;

class issuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $computerId = DB::table('computers')->pluck('id')->toArray();
        $urgency = ['Low', 'Medium', 'High'];
        $status = ['open', 'in progress', 'resolved'];
        //
        for ($i = 0; $i < 30; $i++) {
            DB::table('issues')->insert([
                'computer_id'=>$faker->randomElement($computerId),
                'reported_by'=>$faker->sentence(2, true),
                'reported_date'=>$faker->dateTime(),
                'description'=>$faker->sentence(5, true),
                'urgency'=>$faker->randomElement($urgency),
                'status'=>$faker->randomElement($status)
            ]);
        }
    }
}


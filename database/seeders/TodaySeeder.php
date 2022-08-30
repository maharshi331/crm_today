<?php

namespace Database\Seeders;

use App\Models\Today;
use illuminate\support\Str;
use Illuminate\Database\Seeder;

class TodaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = \Faker\Factory::create();

        for($i=0;$i<5;$i++){
            Today::create([
                'completed'=> false,
                'title'=> $faker->sentence($nbWords=4, $variableWords=false),

                'approved' =>false,
                 'taskId'=>str::random(10),

            ]);
        }
    }
}

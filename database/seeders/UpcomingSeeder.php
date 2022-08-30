<?php

namespace Database\Seeders;
use App\Models\Upcoming;
use illuminate\support\Str;

use Illuminate\Database\Seeder;

class UpcomingSeeder extends Seeder
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
            upcoming::create([
                'completed'=> false,
                'title'=> $faker->sentence($nbWords=4, $variableWords=false),
                'waiting'=>true,
                'approved' =>false,
                 'taskId'=>str::random(10),

            ]);
        }
    }
}

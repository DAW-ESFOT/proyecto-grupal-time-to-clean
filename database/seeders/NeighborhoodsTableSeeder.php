<?php

namespace Database\Seeders;

use App\Models\Neighborhoods;
use Illuminate\Database\Seeder;

class NeighborhoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla
        Neighborhoods::truncate();

        $faker = \Faker\Factory::create();

        //Crear barrios ficitcios en la tabla
        for($i = 0; $i < 20 ; $i++){
            Neighborhoods::create([
                'start_time'=> $faker->time($format = 'H:i:s', $max = 'now'),
                'end_time'=> $faker->time($format = 'H:i:s', $max = 'now'),
                'days'=> $faker->dayOfWeek($max = 'now'),
                'link'=> $faker->url,
                'name'=> $faker->city,
            ]);
        }
    }
}

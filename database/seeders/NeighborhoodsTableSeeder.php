<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Truck;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        Neighborhood::truncate();
        $faker = \Faker\Factory::create();




            $trucks = Truck::all();
            foreach ($trucks as $truck) {
                if($truck->working != false){
                    for($i = 0; $i < 3; $i++){
                        Neighborhood::create([
                            'start_time'=> $faker->time($format = 'H:i:s', $max = 'now'),
                            'end_time'=> $faker->time($format = 'H:i:s', $max = 'now'),
                            'days'=> $faker->dayOfWeek($max = 'now'),
                            'link'=> $faker->url,
                            'name'=> $faker->city,
                            'truck_id'=> $truck->id,
                        ]);
                    }

                }
            }

    }
}

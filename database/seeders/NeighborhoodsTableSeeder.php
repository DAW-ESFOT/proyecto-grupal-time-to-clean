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

        //Inicio de sesion de los users para asignar un camion recolectos a un usuario
        $users = App\Models\User::all();
        foreach ($users as $user) {

            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            $trucks = App\Models\Trucks::all();
            foreach ($trucks as $truck) {
                Neighborhoods::create([
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

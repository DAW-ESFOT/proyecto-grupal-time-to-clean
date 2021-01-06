<?php

namespace Database\Seeders;

use App\Models\Truck;
use Illuminate\Database\Seeder;

class TrucksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla.
        Truck::truncate();
        $faker = \Faker\Factory::create();
        //Inicio de sesion de los users para asignarles un truck
        $users = App\Models\User::all();
        foreach ($users as $user) {
            if($user->role != 'Admin') {
                JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
                Truck::create([
                    'license_plate' => $faker->numerify('PAC-####'),
                    'type' => $faker->randomElement(['Automático', 'Manual']),
                    'working' => true,
                ]);
            }
        }
    }
}

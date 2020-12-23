<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Seeder;

class ComplaintsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla
        Complaint::truncate();
        $faker = \Faker\Factory::create();

        //Crear datos ficticios en la tabla

        for($i = 0; $i < 10; $i++) {
            Complaint::create([
                'complaint'=> $faker->paragraph,
                'username'=> $faker->name,
                'email'=> $faker->email,
                'state'=> 'Pendiente',
                'observation'=>''
            ]);
        }
    }
}

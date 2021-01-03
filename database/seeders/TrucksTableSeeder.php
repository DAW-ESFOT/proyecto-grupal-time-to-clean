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
        // Crear artículos ficticios en la tabla
        Truck::create([
            'license_plate' => "PCI-7356",
            'type' => "Automático",
            'working' => true,
        ]);
        Truck::create([
            'license_plate' => "PCA-7126",
            'type' => "Automático",
            'working' => true,
        ]);
        Truck::create([
            'license_plate' => "PCB-7456",
            'type' => "Automático",
            'working' => false,
        ]);
        Truck::create([
            'license_plate' => "PCC-1256",
            'type' => "Automático",
            'working' => false,
        ]);
        Truck::create([
            'license_plate' => "PCD-7311",
            'type' => "Manual",
            'working' => true,
        ]);
        Truck::create([
            'license_plate' => "PCE-7387",
            'type' => "Automático",
            'working' => true,
        ]);
        Truck::create([
            'license_plate' => "PCF-6756",
            'type' => "Manual",
            'working' => true,
        ]);
        Truck::create([
            'license_plate' => "PCG-4556",
            'type' => "Manual",
            'working' => false,
        ]);
        Truck::create([
            'license_plate' => "PCH-7309",
            'type' => "Manual",
            'working' => true,
        ]);
        Truck::create([
            'license_plate' => "PCJ-7666",
            'type' => "Automático",
            'working' => true,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['ID' => 2422, 'Name' => 'AGUASCALIENTES'],
            ['ID' => 2423, 'Name' => 'BAJA CALIFORNIA'],
            ['ID' => 2424, 'Name' => 'BAJA CALIFORNIA SUR'],
            ['ID' => 2425, 'Name' => 'CAMPECHE'],
            ['ID' => 2426, 'Name' => 'CHIAPAS'],
            ['ID' => 2427, 'Name' => 'CHIHUAHUA'],
            ['ID' => 2428, 'Name' => 'COAHUILA'],
            ['ID' => 2429, 'Name' => 'COLIMA'],
            ['ID' => 2430, 'Name' => 'DISTRITO FEDERAL'],
            ['ID' => 2431, 'Name' => 'DURANGO'],
            ['ID' => 2432, 'Name' => 'GUANAJUATO'],
            ['ID' => 2433, 'Name' => 'GUERRERO'],
            ['ID' => 2434, 'Name' => 'HIDALGO'],
            ['ID' => 2435, 'Name' => 'JALISCO'],
            ['ID' => 2436, 'Name' => 'MEXICO'],
            ['ID' => 2437, 'Name' => 'MICHOACAN'],
            ['ID' => 2438, 'Name' => 'MORELOS'],
            ['ID' => 2439, 'Name' => 'NAYARIT'],
            ['ID' => 2440, 'Name' => 'NUEVO LEON'],
            ['ID' => 2441, 'Name' => 'OAXACA'],
            ['ID' => 2442, 'Name' => 'PUEBLA'],
            ['ID' => 2443, 'Name' => 'QUERETARO'],
            ['ID' => 2444, 'Name' => 'QUINTANA ROO'],
            ['ID' => 2445, 'Name' => 'SAN LUIS POTOSI'],
            ['ID' => 2446, 'Name' => 'SINALOA'],
            ['ID' => 2447, 'Name' => 'SONORA'],
            ['ID' => 2448, 'Name' => 'TABASCO'],
            ['ID' => 2449, 'Name' => 'TAMAULIPAS'],
            ['ID' => 2450, 'Name' => 'TLAXCALA'],
            ['ID' => 2451, 'Name' => 'VERACRUZ'],
            ['ID' => 2452, 'Name' => 'YUCATAN'],
            ['ID' => 2453, 'Name' => 'ZACATECAS']
        ];

        State::insert($states);
    }
}

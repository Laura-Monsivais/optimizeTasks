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
            ['ID' => 2422, 'Name' => 'AGUASCALIENTES', 'Short' => 'AGS'],
            ['ID' => 2423, 'Name' => 'BAJA CALIFORNIA','Short' => 'BC'],
            ['ID' => 2424, 'Name' => 'BAJA CALIFORNIA SUR','Short' => 'BCS'],
            ['ID' => 2425, 'Name' => 'CAMPECHE','Short' => 'CAMP'],
            ['ID' => 2426, 'Name' => 'CHIAPAS','Short' => 'CHIS'],
            ['ID' => 2427, 'Name' => 'CHIHUAHUA','Short' => 'CHIH'],
            ['ID' => 2428, 'Name' => 'COAHUILA','Short' => 'COAH'],
            ['ID' => 2429, 'Name' => 'COLIMA','Short' => 'COL'],
            ['ID' => 2430, 'Name' => 'DISTRITO FEDERAL','Short' => 'DF'],
            ['ID' => 2431, 'Name' => 'DURANGO','Short' => 'DGO'],
            ['ID' => 2432, 'Name' => 'GUANAJUATO', 'Short' => 'GTO'],
            ['ID' => 2433, 'Name' => 'GUERRERO', 'Short' => 'GRO'],
            ['ID' => 2434, 'Name' => 'HIDALGO', 'Short' => 'HGO'],
            ['ID' => 2435, 'Name' => 'JALISCO', 'Short' => 'JAL'],
            ['ID' => 2436, 'Name' => 'MEXICO', 'Short' => 'MEX'],
            ['ID' => 2437, 'Name' => 'MICHOACAN', 'Short' => 'MICH'],
            ['ID' => 2438, 'Name' => 'MORELOS', 'Short' => 'MOR'],
            ['ID' => 2439, 'Name' => 'NAYARIT', 'Short' => 'NAY'],
            ['ID' => 2440, 'Name' => 'NUEVO LEON', 'Short' => 'NL'],
            ['ID' => 2441, 'Name' => 'OAXACA', 'Short' => 'OAX'],
            ['ID' => 2442, 'Name' => 'PUEBLA', 'Short' => 'PUE'],
            ['ID' => 2443, 'Name' => 'QUERETARO', 'Short' => 'QRO'],
            ['ID' => 2444, 'Name' => 'QUINTANA ROO', 'Short' => 'QROO'],
            ['ID' => 2445, 'Name' => 'SAN LUIS POTOSI', 'Short' => 'SLP'],
            ['ID' => 2446, 'Name' => 'SINALOA', 'Short' => 'SIN'],
            ['ID' => 2447, 'Name' => 'SONORA', 'Short' => 'SON'],
            ['ID' => 2448, 'Name' => 'TABASCO', 'Short' => 'TAB'],
            ['ID' => 2449, 'Name' => 'TAMAULIPAS', 'Short' => 'TAMPS'],
            ['ID' => 2450, 'Name' => 'TLAXCALA', 'Short' => 'TLAX'],
            ['ID' => 2451, 'Name' => 'VERACRUZ', 'Short' => 'VER'],
            ['ID' => 2452, 'Name' => 'YUCATAN', 'Short' => 'YUC'],
            ['ID' => 2453, 'Name' => 'ZACATECAS', 'Short' => 'ZAC']
        ];

        State::insert($states);
    }
}

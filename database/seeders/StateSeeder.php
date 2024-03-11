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
            ['ID' => 2422, 'Name' => 'AGUASCALIENTES', 'Abreviatura' => 'AGS'],
            ['ID' => 2423, 'Name' => 'BAJA CALIFORNIA','Abreviatura' => 'BC'],
            ['ID' => 2424, 'Name' => 'BAJA CALIFORNIA SUR','Abreviatura' => 'BCS'],
            ['ID' => 2425, 'Name' => 'CAMPECHE','Abreviatura' => 'CAMP'],
            ['ID' => 2426, 'Name' => 'CHIAPAS','Abreviatura' => 'CHIS'],
            ['ID' => 2427, 'Name' => 'CHIHUAHUA','Abreviatura' => 'CHIH'],
            ['ID' => 2428, 'Name' => 'COAHUILA','Abreviatura' => 'COAH'],
            ['ID' => 2429, 'Name' => 'COLIMA','Abreviatura' => 'COL'],
            ['ID' => 2430, 'Name' => 'DISTRITO FEDERAL','Abreviatura' => 'DF'],
            ['ID' => 2431, 'Name' => 'DURANGO','Abreviatura' => 'DGO'],
            ['ID' => 2432, 'Name' => 'GUANAJUATO', 'Abreviatura' => 'GTO'],
            ['ID' => 2433, 'Name' => 'GUERRERO', 'Abreviatura' => 'GRO'],
            ['ID' => 2434, 'Name' => 'HIDALGO', 'Abreviatura' => 'HGO'],
            ['ID' => 2435, 'Name' => 'JALISCO', 'Abreviatura' => 'JAL'],
            ['ID' => 2436, 'Name' => 'MEXICO', 'Abreviatura' => 'MEX'],
            ['ID' => 2437, 'Name' => 'MICHOACAN', 'Abreviatura' => 'MICH'],
            ['ID' => 2438, 'Name' => 'MORELOS', 'Abreviatura' => 'MOR'],
            ['ID' => 2439, 'Name' => 'NAYARIT', 'Abreviatura' => 'NAY'],
            ['ID' => 2440, 'Name' => 'NUEVO LEON', 'Abreviatura' => 'NL'],
            ['ID' => 2441, 'Name' => 'OAXACA', 'Abreviatura' => 'OAX'],
            ['ID' => 2442, 'Name' => 'PUEBLA', 'Abreviatura' => 'PUE'],
            ['ID' => 2443, 'Name' => 'QUERETARO', 'Abreviatura' => 'QRO'],
            ['ID' => 2444, 'Name' => 'QUINTANA ROO', 'Abreviatura' => 'QROO'],
            ['ID' => 2445, 'Name' => 'SAN LUIS POTOSI', 'Abreviatura' => 'SLP'],
            ['ID' => 2446, 'Name' => 'SINALOA', 'Abreviatura' => 'SIN'],
            ['ID' => 2447, 'Name' => 'SONORA', 'Abreviatura' => 'SON'],
            ['ID' => 2448, 'Name' => 'TABASCO', 'Abreviatura' => 'TAB'],
            ['ID' => 2449, 'Name' => 'TAMAULIPAS', 'Abreviatura' => 'TAMPS'],
            ['ID' => 2450, 'Name' => 'TLAXCALA', 'Abreviatura' => 'TLAX'],
            ['ID' => 2451, 'Name' => 'VERACRUZ', 'Abreviatura' => 'VER'],
            ['ID' => 2452, 'Name' => 'YUCATAN', 'Abreviatura' => 'YUC'],
            ['ID' => 2453, 'Name' => 'ZACATECAS', 'Abreviatura' => 'ZAC']
        ];

        State::insert($states);
    }
}

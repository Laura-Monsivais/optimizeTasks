<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = [
            ['Name' => 'Aguascalientes', 'Short' => 'AS'],
            ['Name' => 'Baja California Norte', 'Short' => 'BC'],
            ['Name' => 'Baja California Sur', 'Short' => 'BS'],
            ['Name' => 'Campeche', 'Short' => 'CC'],
            ['Name' => 'Chihuahua', 'Short' => 'CH'],
            ['Name' => 'Chiapas', 'Short' => 'CS'],
            ['Name' => 'Coahuila', 'Short' => 'CL'],
            ['Name' => 'Colima', 'Short' => 'CM'],
            ['Name' => 'Distrito Federal', 'Short' => 'DF'],
            ['Name' => 'Durango', 'Short' => 'DG'],
            ['Name' => 'Guanajuato', 'Short' => 'GT'],
            ['Name' => 'Guerrero', 'Short' => 'GR'],
            ['Name' => 'Hidalgo', 'Short' => 'HG'],
            ['Name' => 'Jalisco', 'Short' => 'JC'],
            ['Name' => 'Estado de México', 'Short' => 'MC'],
            ['Name' => 'Michoacán', 'Short' => 'MN'],
            ['Name' => 'Morelos', 'Short' => 'MS'],
            ['Name' => 'Nayarit', 'Short' => 'NT'],
            ['Name' => 'Nuevo León', 'Short' => 'NL'],
            ['Name' => 'Oaxaca', 'Short' => 'OC'],
            ['Name' => 'Puebla', 'Short' => 'PL'],
            ['Name' => 'Querétaro', 'Short' => 'QT'],
            ['Name' => 'Quintana Roo', 'Short' => 'QR'],
            ['Name' => 'San Luis Potosí', 'Short' => 'SP'],
            ['Name' => 'Sinaloa', 'Short' => 'SL'],
            ['Name' => 'Sonora', 'Short' => 'SR'],
            ['Name' => 'Tabasco', 'Short' => 'TC'],
            ['Name' => 'Tamaulipas', 'Short' => 'TS'],
            ['Name' => 'Tlaxcala', 'Short' => 'TL'],
            ['Name' => 'Veracruz', 'Short' => 'VZ'],
            ['Name' => 'Yucatán', 'Short' => 'YN'],
            ['Name' => 'Zacatecas', 'Short' => 'ZS'],
            ['Name' => 'Extranjero', 'Short' => 'NE']
        ];

        Place::insert($places);
    }
}

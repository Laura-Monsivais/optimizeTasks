<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $nationalities = [
            ['ID' => 1, 'Name' => 'Mexicano'],
            ['ID' => 2, 'Name' => 'Estadounidense'],
            ['ID' => 3, 'Name' => 'Canadiense'],
            ['ID' => 4, 'Name' => 'Argentino'],
            ['ID' => 5, 'Name' => 'Venezolano'],
            ['ID' => 6, 'Name' => 'Colombiano'],
            ['ID' => 7, 'Name' => 'Brasileño'],
            ['ID' => 8, 'Name' => 'Japonés'],
            ['ID' => 9, 'Name' => 'Coreano'],
            ['ID' => 10,'Name' => 'Chino'],
            ['ID' => 11,'Name' => 'Español'],
            ['ID' => 12,'Name' => 'Húngaro'],
            ['ID' => 13,'Name' => 'Alemán'],
            ['ID' => 14,'Name' => 'Francés'],
            ['ID' => 15,'Name' => 'Hondureño'],
            ['ID' => 16,'Name' => 'Ecuatoriano'],
            ['ID' => 17,'Name' => 'Panameño'],
            ['ID' => 18,'Name' => 'Turco'],
            ['ID' => 19,'Name' => 'Italiano'],
            ['ID' => 20,'Name' => 'Peruano'],
            ['ID' => 21,'Name' => 'Chileno'],
            ['ID' => 22,'Name' => 'Norcoreano']
        ];
        Nationality::insert($nationalities);
    }
}

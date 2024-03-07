<?php

namespace Database\Seeders;

use App\Models\ClassLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $classlevel = [
            ['ID' => 1, 'Name' => 'Guarderia','Short' => 'GRD'],
            ['ID' => 2, 'Name' => 'Lactantes','Short' => 'LAC'],
            ['ID' => 3, 'Name' => 'Maternal','Short' => 'MAT'],
            ['ID' => 4, 'Name' => '1K','Short' => '1K'],
            ['ID' => 5, 'Name' => '2K','Short' => '2K'],
            ['ID' => 6, 'Name' => '3K','Short' => '3K'],
            ['ID' => 7, 'Name' => '1ro Prim','Short' => '1P'],
            ['ID' => 8, 'Name' => '2do Prim','Short' => '2P'],
            ['ID' => 9, 'Name' => '3ro Prim','Short' => '3P'],
            ['ID' => 10,'Name' => '4to Prim','Short' => '4P'],
            ['ID' => 11,'Name' => '5to Prim','Short' => '5P'],
            ['ID' => 12,'Name' => '6to Prim','Short' => '6P'],
            ['ID' => 13,'Name' => '1ro Sec','Short' => '1S'],
            ['ID' => 14,'Name' => '2do Sec','Short' => '2S'],
            ['ID' => 15,'Name' => '3ro Sec','Short' => '3S'],
            ['ID' => 16,'Name' => '1er Semestre','Short' => 'I'],
            ['ID' => 17,'Name' => '2do Semestre','Short' => 'II'],
            ['ID' => 18,'Name' => '3er Semestre','Short' => 'III'],
            ['ID' => 19,'Name' => '4to Semestre','Short' => 'IV'],
            ['ID' => 20,'Name' => '5to Semestre','Short' => 'V'],
            ['ID' => 21,'Name' => '6to Semestre','Short' => 'VI']
        ];
        ClassLevel::insert($classlevel);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Students;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Students::create([
            'Name' => 'Laura',
            'Last' => 'Monsivais',
            'Last2' => 'Flores',
            'Gender' => 'M',
            'CURP' => 'MOFL970419MASNLR09',
            'MaritalStatusID' => 1,
            'BirthDate' => '1997-04-19',
            'BirthCity' => 'Aguascalientes',
            'BirthPlaceID' => 15,
            'NationalityID' => 1
        ]);

        Students::create([
            'Name' => 'Miguel',
            'Last' => 'Mauricio',
            'Last2' => 'Calvillo',
            'Gender' => 'H',
            'CURP' => 'MACM261096MASNLR08',
            'MaritalStatusID' => 1,
            'BirthDate' => '1996-10-26',
            'BirthCity' => 'Aguascalientes',
            'BirthPlaceID' => 15,
            'NationalityID' => 1
        ]);
    }
}

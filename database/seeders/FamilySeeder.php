<?php

namespace Database\Seeders;

use App\Models\Family;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Family::create([
            'LastName1' => 'Rodriguez',
            'LastName2' => 'Peralta',
            'Address1' => 'Paseo de los Leones',
            'ExtNum' => '405',
            'IntNum' => '105',
            'Address2' => '',
            'City' => 'Monterrey',
            'County' => 'Mexico',
            'StateID' => 2422,
            'CodigoPostal' => '64460',
            'CountryID' => 142,
            'Phone1' => '1',
            'Phone2' => '1'
        ]);
    }
}

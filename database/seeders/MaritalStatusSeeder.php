<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maritals = [
            ['ID' => 1, 'Name' => 'Soltero'],
            ['ID' => 2, 'Name' => 'Casado'],
            ['ID' => 3, 'Name' => 'Separado'],
            ['ID' => 4, 'Name' => 'Divorciado'],
            ['ID' => 5, 'Name' => 'Viudo'],
            ['ID' => 6, 'Name' => 'Unión']
        ];
        MaritalStatus::insert($maritals);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call(PlaceSeeder::class);
      $this->call(StateSeeder::class);
      $this->call(CountrySeeder::class);
      $this->call(MaritalStatusSeeder::class);
      $this->call(NationalitySeeder::class);
      $this->call(FamilySeeder::class);
      $this->call(StudentSeeder::class);
      $this->call(ClassLevelSeeder::class);

    }
}

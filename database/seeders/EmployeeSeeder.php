<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = new Employee();
        $employees->truncate();
        $faker = Faker::create();
        for ($i = 0; $i < 6; $i++) {
            $employees->insert([
                'name' => $faker->name(),
                'description' => $faker->text(),
            ]);
        }

    }
}

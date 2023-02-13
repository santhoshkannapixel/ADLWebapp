<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Department = [
            ["name" => "Cytogenetics","status" => 1],
            ["name" => "Hematology","status" => 1],
            ["name" => "Microbiology","status" => 1]
        ];
        Department::insert($Department);
    }
}

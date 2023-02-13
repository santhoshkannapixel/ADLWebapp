<?php

namespace Database\Seeders;

use App\Models\JobPost;
use Illuminate\Database\Seeder;

class JobPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $JobPost = [
            [
                'title'             => "Senior Resident/Pathologist",
                'code'              => "HR/MH 21-08",
                'location'          => "Bengaluru",
                'department_id'     => 1,
                'experience'        => "Fresher or 2-3 years",
                'responsibilities'  => "Manages overall go-to-market strategy for syringe pump & Infusion Pump product lines, including overall commercial planning, key marketing initiatives, and financial results for the product line.",
                'qualification'     => "MBBS, MD Pathology/ MBBS, MD Anatomy",
                'no_of_requirement' => 5,
                'status'            => 1,
            ],
            [
                'title'             => "Product Specialist",
                'code'              => "HR/MH 22-10",
                'location'          => "Chennai",
                'department_id'     => 2,
                'experience'        => "3-4 Years",
                'responsibilities'  => "Manages overall go-to-market strategy for syringe pump & Infusion Pump product lines, including overall commercial planning, key marketing initiatives, and financial results for the product line.",
                'qualification'     => "MBBS, MD Pathology/ MBBS, MD Anatomy",
                'no_of_requirement' => 2,
                'status'            => 1,
            ],
            [
                'title'             => "Product Specialist",
                'code'              => "AR/MH 38-38",
                'location'          => "Bengaluru",
                'department_id'     => 2,
                'experience'        => "0-2 Years",
                'responsibilities'  => "Manages overall go-to-market strategy for syringe pump & Infusion Pump product lines, including overall commercial planning, key marketing initiatives, and financial results for the product line.",
                'qualification'     => "MBBS, MD Pathology/ MBBS, MD Anatomy",
                'no_of_requirement' => 10,
                'status'            => 1,
            ]
        ];
        JobPost::inset($JobPost);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAndRolesSeeder extends Seeder
{
    public function run()
    {
        Roles::create([
            "name" => 'Admin',
            "slug" => 'Admin',
            "user_id" => 1,
        ]);
        User::create([
            'name' => 'Benjamin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 1
        ]);

        Roles::create([
            "name" => 'Employee',
            "slug" => 'Employee',
            "user_id" => 2,
            "permissions" => json_encode([
                "PATIENTS_CONSUMERS_INDEX" => "true",
                "FEEDBACK_INDEX" => "true",
                "FAQ_INDEX" => "true",
                "HOSPITAL_LAB_MANAGEMENT_INDEX" => "true",
                "CLINICAL_LAB_MANAGEMENT_INDEX" => "true",
                "FRANCHISING_OPPORTUNITIES_INDEX" => "true",
                "RESEARCH_INDEX" => "true",
                "BOOK_AN_APPOINTMENT_INDEX" => "true",
                "NEWS_LETTER_INDEX" => "true",
                "DASHBOARD_INDEX" => "true",
                "ADMIN_PATIENTS" => "true",
                "ADMIN_DOCTORS" => "true",
                "ADMIN_HEALTH_CHECKUP" => "true",
                "ADMIN_REACH_US" => "true",
                "BANNER_INDEX" => "true",
                "ORDERS_INDEX" => "true"
            ])
        ]);
        User::create([
            'name' => 'William',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2
        ]);
    }
}

<?php

namespace Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;

class UserAndRolesSeeder extends Seeder
{
    public function run()
    {
        #========Create ADmin======
        $Admin = Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'Admin',
            'slug'       => 'admin',
        ]);
        $Admin->users()->attach(Sentinel::registerAndActivate([
            'email' => 'admin@gmail.com',
            'name'  => 'Alexia',
            'mobile'  => '',
            'password' => 12345678,
        ]));
        #========Create Employees======
        $Employee = Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'Employee',
            'slug'       => 'Employee',
            "permissions" => [
                "DASHBOARD_INDEX" => "1",
                "USER_INDEX" => "1",
                "USER_CREATE" => "0",
                "USER_STORE" => "0",
                "USER_EDIT" => "0",
                "USER_UPDATE" => "0",
                "USER_DELETE" => "0",
                "ROLE_INDEX" => "1",
                "ROLE_CREATE" => "0",
                "ROLE_STORE" => "0",
                "ROLE_EDIT" => "0",
                "ROLE_UPDATE" => "0",
                "ROLE_DELETE" => "0",
                "API_CONFIG_INDEX" => "1",
                "API_CONFIG_CREATE" => "0",
                "API_CONFIG_STORE" => "0",
                "API_CONFIG_EDIT" => "0",
                "API_CONFIG_UPDATE" => "0",
                "API_CONFIG_DELETE" => "0",
                "PAYMENT_CONFIG_INDEX" => "1",
                "PAYMENT_CONFIG_CREATE" => "0",
                "PAYMENT_CONFIG_STORE" => "0",
                "PAYMENT_CONFIG_EDIT" => "0",
                "PAYMENT_CONFIG_UPDATE" => "0",
                "PAYMENT_CONFIG_DELETE" => "0",
                "BRANCH_SYNC" => "0",
                "BRANCH_SHOW" => "0",
                "CITY_INDEX" => "1",
                "CITY_SYNC" => "0",
                "TEST_INDEX" => "1",
                "TEST_SYNC" => "0",
                "TEST_SHOW" => "0",
                "TEST_EDIT" => "0",
                "BANNER_INDEX" => "1",
                "BANNER_CREATE" => "0",
                "BANNER_STORE" => "0",
                "BANNER_EDIT" => "0",
                "BANNER_DELETE" => "0",
                "NEWS_LETTER_INDEX" => "1",
                "NEWS_LETTER_SHOW" => "0",
                "NEWS_LETTER_DELETE" => "0",
                "NEWS_AND_EVENTS_INDEX" => "1",
                "NEWS_AND_EVENTS_CREATE" => "0",
                "NEWS_AND_EVENTS_STORE" => "0",
                "NEWS_AND_EVENTS_UPDATE" => "0",
                "NEWS_AND_EVENTS_EDIT" => "0",
                "NEWS_AND_EVENTS_DESTROY" => "0",
                "ORDERS_INDEX" => "1",
                "ORDERS_SHOW" => "0",
                "ORDERS_CHANGE_ORDER_STATUS" => "0",
                "CUSTOMERS_INDEX" => "1",
                "PATIENTS_INDEX" => "1",
                "DOCTORS_INDEX" => "1",
                "HEALTH_CHECKUP_INDEX" => "1",
                "REACH_US_INDEX" => "1",
                "HOME_COLLECTION_INDEX" => "1",
                "HOME_COLLECTION_DELETE" => "0",
                "HOME_COLLECTION_SHOW" => "0",
                "FEEDBACK_INDEX" => "1",
                "FEEDBACK_DELETE" => "0",
                "FEEDBACK_SHOW" => "0",
                "FAQ_INDEX" => "1",
                "FAQ_DELETE" => "0",
                "FAQ_SHOW" => "0",
                "HOSPITAL_LAB_MANAGEMENT_INDEX" => "1",
                "HOSPITAL_LAB_MANAGEMENT_DELETE" => "0",
                "HOSPITAL_LAB_MANAGEMENT_SHOW" => "0",
                "CLINICAL_LAB_MANAGEMENT_INDEX" => "1",
                "CLINICAL_LAB_MANAGEMENT_DELETE" => "0",
                "CLINICAL_LAB_MANAGEMENT_SHOW" => "0",
                "FRANCHISING_OPPORTUNITIES_INDEX" => "1",
                "FRANCHISING_OPPORTUNITIES_DELETE" => "0",
                "FRANCHISING_OPPORTUNITIES_SHOW" => "0",
                "RESEARCH_INDEX" => "1",
                "RESEARCH_DELETE" => "0",
                "RESEARCH_SHOW" => "0",
                "PATIENTS_CONSUMERS_INDEX" => "1",
                "PATIENTS_CONSUMERS_DELETE" => "0",
                "PATIENTS_CONSUMERS_SHOW" => "0",
                "BOOK_AN_APPOINTMENT_INDEX" => "1",
                "BOOK_AN_APPOINTMENT_DELETE" => "0",
                "BOOK_AN_APPOINTMENT_SHOW" => "0",
                "HEAD_OFFICE_INDEX" => "1",
                "HEAD_OFFICE_DELETE" => "0",
                "HEAD_OFFICE_SHOW" => "0"
            ]
        ]);
        $Employee->users()->attach(Sentinel::registerAndActivate([
            'email' => 'user@gmail.com',
            'name'  => 'Alexia',
            'mobile'  => '',
            'password' => 12345678,
        ]));
    }
}

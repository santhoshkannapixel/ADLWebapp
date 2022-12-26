<?php

namespace Database\Seeders;

use App\Models\ApiConfig;
use Illuminate\Database\Seeder;

class ApiLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApiConfig::create([
            'apiUrl' => 'https://reports.anandlab.com/v3/labapi.asmx/GetTestMaster',
            'corporateID' => '514',
            'passCode' => 'neuberg123',
            'apiType' => 'GetTestMaster',
            'location' => 'Bangalore',
            'location_slug' => 'bangalore',
            'created_by' => 'Admin',
        ]);

        ApiConfig::create([
            'apiUrl' => 'https://reports.anandlab.com/v3/labapi.asmx/GetTestMaster',
            'corporateID' => '1140',
            'passCode' => 'LMLOR34815',
            'apiType' => 'GetTestMaster',
            'location' => 'Mangalore',
            'location_slug' => 'mangalore',
            'created_by' => 'Admin'
        ]);

        ApiConfig::create([
            'apiUrl' => 'https://reports.anandlab.com/v3/labapi.asmx/GetTestMaster',
            'corporateID' => '3360',
            'passCode' => 'MEVIS7618',
            'apiType' => 'GetTestMaster',
            'location' => 'Rest of Bangalore',
            'location_slug' => 'rest-of-bangalore',
            'created_by' => 'Admin'
        ]);
        // ==================
        ApiConfig::create([
            'apiUrl' => 'https://reports.anandlab.com/v3/labapi.asmx/GetBranchMaster',
            'corporateID' => '3360',
            'passCode' => 'MEVIS7618',
            'apiType' => 'GetBranchMaster',
            'location' => 'Bangalore',
            'location_slug' => 'bangalore',
            'created_by' => 'Admin'
        ]);

        ApiConfig::create([
            'apiUrl' => 'https://reports.anandlab.com/v3/labapi.asmx/GetBranchMaster',
            'corporateID' => '1140',
            'passCode' => 'LMLOR34815',
            'apiType' => 'GetBranchMaster',
            'location' => 'Mangalore',
            'location_slug' => 'mangalore',
            'created_by' => 'Admin'
        ]);

        ApiConfig::create([
            'apiUrl' => 'https://reports.anandlab.com/v3/labapi.asmx/GetBranchMaster',
            'corporateID' => '3360',
            'passCode' => 'MEVIS7618',
            'apiType' => 'GetBranchMaster',
            'location' => 'Rest of Bangalore',
            'location_slug' => 'rest-of-bangalore',
            'created_by' => 'Admin'
        ]);
        // /================
        ApiConfig::create([
            'apiUrl' => 'https://reports.anandlab.com/v3/labapi.asmx/GetCityMaster',
            'corporateID' => '3360',
            'passCode' => 'MEVIS7618',
            'apiType' => 'GetCityMaster',
            'location' => 'Bangalore',
            'location_slug' => 'bangalore',
            'created_by' => 'Admin'
        ]);

        ApiConfig::create([
            'apiUrl' => 'https://reports.anandlab.com/v3/labapi.asmx/GetCityMaster',
            'corporateID' => '1140',
            'passCode' => 'LMLOR34815',
            'apiType' => 'GetCityMaster',
            'location' => 'Mangalore',
            'location_slug' => 'mangalore',
            'created_by' => 'Admin'
        ]);

        ApiConfig::create([
            'apiUrl' => 'https://reports.anandlab.com/v3/labapi.asmx/GetCityMaster',
            'corporateID' => '3360',
            'passCode' => 'MEVIS7618',
            'apiType' => 'GetCityMaster',
            'location' => 'Rest of Bangalore',
            'location_slug' => 'rest-of-bangalore',
            'created_by' => 'Admin'
        ]);
    }
}

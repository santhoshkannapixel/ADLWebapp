<?php

namespace Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        #========Create User======
        $credentials = [
            'email'     => 'alexia@gmail.com',
            'password'  =>  '12345678',
            'name'      =>  'Christopher',
        ];
        $userDb = Sentinel::registerAndActivate( $credentials );

        #======Create Role=======
        Sentinel::getRoleRepository()->createModel()->create( [
            'name'       => 'Super Admin',
            'slug'       => 'admin',
        ])->users()->attach($userDb);
  
        Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'System Admin',
            'slug'       => 'system-admin',
            'permissions'=> config('permission'),
        ]);

        $employee = Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'Staff',
            'slug'       => 'staff',
            'permissions'=> config('permission'),
        ]);

        $employee->users()->attach(Sentinel::registerAndActivate(['email' => 'user@gmail.com','password'   => '12345678','name' => 'James Smith']));
        $employee->users()->attach(Sentinel::registerAndActivate(['email' => 'sales@gmail.com','password'   => '12345678','name' => 'Alex']));
    }
}
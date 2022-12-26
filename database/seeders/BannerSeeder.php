<?php

namespace Database\Seeders;

use App\Models\Banners;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banners::create([
            'Title' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.',
            'Content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem temporibus dolores nobis, voluptas architecto assumenda commodi eaque. Quia aspernatur blanditiis ipsa tempora modi iure, est recusandae officiis illo, delectus distinctio!' ,
            'Url' => "http://adladmin.pixel-studios.net",
            'DesktopImage' => 'http://adladmin.pixel-studios.net/storage/app/public/files/desktop_images/9IleCQD1qe6hv15ukcnwCuonZopliD4Fao4c1CzT.jpg',
            'MobileImage'=>'http://adladmin.pixel-studios.net/storage/app/public/files/mobile_images/jjFSOV0Cp88v68kd6w05xjsr1uhwztwwpXsxKOKf.jpg',
            'OrderBy' => 1,
        ]);
        Banners::create([
            'Title' => 'Voluptatem temporibus dolores nobis, voluptas architecto assumenda commodi eaque.',
            'Content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem temporibus dolores nobis, voluptas architecto assumenda commodi eaque. Quia aspernatur blanditiis ipsa tempora modi iure, est recusandae officiis illo, delectus distinctio!' ,
            'Url' => "http://adladmin.pixel-studios.net",
            'DesktopImage' => 'http://adladmin.pixel-studios.net/storage/app/public/files/desktop_images/9IleCQD1qe6hv15ukcnwCuonZopliD4Fao4c1CzT.jpg',
            'MobileImage'=>'http://adladmin.pixel-studios.net/storage/app/public/files/mobile_images/jjFSOV0Cp88v68kd6w05xjsr1uhwztwwpXsxKOKf.jpg',
            'OrderBy' => 1,
        ]);
    }
}

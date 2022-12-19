<?php

namespace Database\Seeders;

use App\Models\NewsEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsAndEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsEvent::create([
            'title'       => 'Genetics For The Obstetricians',
            'slug'        => Str::slug('Genetics For The Obstetricians'),
            'description' => 'Those who know ultrasound, unlock with keys; those who know biochemistry, decipher clues and those who master genetics for obstetricians, solve puzzles in a jiffy!z',
            'posted_by'   => 1,
        ]);
        NewsEvent::create([
            'title'       => 'Early Detection, Diagnosis and Management of Blood Cancer/Disorders ',
            'slug'        => Str::slug('Early Detection, Diagnosis and Management of Blood Cancer/Disorders '),
            'description' => 'Dr. Joseph John MBBS, MD, DM, Head of Clinical Haematology unit at CMC, Ludhiana',
            'posted_by'   => 1,
        ]);
        NewsEvent::create([
            'title'       => 'Genetics For The Obstetricians',
            'slug'        => Str::slug('Genetics For The Obstetricians'),
            'description' => 'Those who know ultrasound, unlock with keys; those who know biochemistry, decipher clues and those who master genetics for obstetricians, solve puzzles in a jiffy!z',
            'posted_by'   => 1,
        ]);
        NewsEvent::create([
            'title'       => 'Early Detection, Diagnosis and Management of Blood Cancer/Disorders ',
            'slug'        => Str::slug('Early Detection, Diagnosis and Management of Blood Cancer/Disorders '),
            'description' => 'Dr. Joseph John MBBS, MD, DM, Head of Clinical Haematology unit at CMC, Ludhiana',
            'posted_by'   => 1,
        ]);
    }
}

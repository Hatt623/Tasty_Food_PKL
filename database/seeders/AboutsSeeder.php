<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Import
use DB;
use App\Models\About;

class AboutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('abouts')->delete();

        About::create ([
            'about' => 'ceritakan tentang restoran anda!',
            'vision' => 'Masukkan visi restoran anda!',
            'mission' => 'Masukkan visi restoran anda!',
            'image_vision' => 'image.png',
            'image_mission' => 'image.png',
        ]);
    }
}

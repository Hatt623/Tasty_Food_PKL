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

       About::create([
            'about' => 'Restoran kami menghadirkan pengalaman fine dining yang elegan dengan hidangan eksklusif, bahan premium, dan sentuhan seni plating yang memanjakan indera. Setiap sajian dirancang untuk memberikan perjalanan rasa yang unik dan tak terlupakan.',
            'vision' => 'Menjadi destinasi kuliner fine dining terbaik di Indonesia yang dikenal karena kualitas, kreativitas, dan pelayanan kelas dunia.',
            'mission' => 'Menyajikan hidangan dengan bahan terbaik, menghadirkan inovasi kuliner yang berkelas, serta memberikan pelayanan personal yang hangat dan profesional kepada setiap tamu.',
            'image_vision' => 'uploads/abouts/image.png',
            'image_mission' => 'uploads/abouts/image.png',
        ]);

    }
}

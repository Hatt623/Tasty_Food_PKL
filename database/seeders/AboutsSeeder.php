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
            'image_vision' => 'uploads/abouts/9ivnJcHslL4unbGyfCx9.jpg',
            'image_mission' => 'uploads/abouts/zHUaQDDU4IKjAxSAgA4S.jpg',
            'email' => 'Delicacy@gmail.com',
            'phone' => '+62 812 3456 7890',
            'address' => 'Kota Bandung, Jawa Barat',
            'map_embed' => '<iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63344.39168152261!2d107.560755!3d-6.934469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7f3e0f1b3a1%3A0x401e8f1fc28c6e0!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1694012345678"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>'

        ]);

    }
}

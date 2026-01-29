<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Import
use DB;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->delete();
        
        $news = [
            ['title' => 'Restoran Fine Dining Baru Dibuka di Jakarta', 'description' => 'Restoran ini menawarkan pengalaman kuliner mewah dengan menu degustasi enam hidangan.', 'image' => 'uploads/news/DfGhJkLzXcVbNmQwErTy.jpg'],
            ['title' => 'Chef Michelin Bintang Tiga Hadir di Bali', 'description' => 'Chef internasional menghadirkan kreasi kuliner modern dengan sentuhan lokal Bali.', 'image' => 'uploads/news/KlMnOpQrStUvWxYzAbCd.jpg'],
            ['title' => 'Wine Pairing Eksklusif di Restoran Surabaya', 'description' => 'Acara wine pairing menghadirkan koleksi wine premium dari Prancis dan Italia.', 'image' => 'uploads/news/OpAsDfGhJkLzXcVbNmQw.jpg'],
            ['title' => 'Festival Gastronomi Nusantara', 'description' => 'Festival ini menampilkan hidangan tradisional Indonesia dengan sentuhan fine dining.', 'image' => 'uploads/news/TrQwXyZaSdFgHjKlMnOp.jpg'],
            ['title' => 'Menu Degustasi Musiman di Bandung', 'description' => 'Chef menghadirkan menu degustasi musiman dengan bahan segar lokal.', 'image' => 'uploads/news/ZxCvBnMqWeRtYuIoPaSd.jpg'],
            ['title' => 'Restoran Rooftop dengan Pemandangan Kota', 'description' => 'Pengalaman makan malam romantis di rooftop dengan menu fine dining.', 'image' => 'uploads/news/DfGhJkLzXcVbNmQwErTy.jpg'],
            ['title' => 'Kolaborasi Chef Lokal dan Internasional', 'description' => 'Kolaborasi menghasilkan menu fusion unik antara kuliner Asia dan Eropa.', 'image' => 'uploads/news/KlMnOpQrStUvWxYzAbCd.jpg'],
            ['title' => 'Peluncuran Menu Vegan Fine Dining', 'description' => 'Restoran menghadirkan menu vegan eksklusif dengan plating artistik.', 'image' => 'uploads/news/TrQwXyZaSdFgHjKlMnOp.jpg'],
            ['title' => 'Dinner Eksklusif dengan Live Jazz', 'description' => 'Pengalaman makan malam ditemani musik jazz live di restoran mewah.', 'image' => 'uploads/news/ZxCvBnMqWeRtYuIoPaSd.jpg'],
            ['title' => 'Chef Table Experience di Jakarta', 'description' => 'Chef table memberikan pengalaman intim dengan hidangan langsung dari dapur.', 'image' => 'uploads/news/DfGhJkLzXcVbNmQwErTy.jpg'],
            ['title' => 'Pameran Wine Premium di Jakarta', 'description' => 'Pameran wine menghadirkan koleksi langka dari Bordeaux dan Napa Valley.', 'image' => 'uploads/news/OpAsDfGhJkLzXcVbNmQw.jpg'],
            ['title' => 'Restoran Fine Dining dengan Menu Molecular Gastronomy', 'description' => 'Menu molecular gastronomy menghadirkan pengalaman kuliner futuristik.', 'image' => 'uploads/news/TrQwXyZaSdFgHjKlMnOp.jpg'],
            ['title' => 'Brunch Eksklusif di Hotel Bintang Lima', 'description' => 'Brunch mewah dengan pilihan seafood segar dan dessert premium.', 'image' => 'uploads/news/ZxCvBnMqWeRtYuIoPaSd.jpg'],
            ['title' => 'Festival Cheese dan Wine', 'description' => 'Festival menghadirkan pairing keju artisan dengan wine internasional.', 'image' => 'uploads/news/DfGhJkLzXcVbNmQwErTy.jpg'],
            ['title' => 'Restoran Fine Dining dengan Menu Tasting 10 Hidangan', 'description' => 'Menu tasting 10 hidangan menghadirkan perjalanan rasa yang unik.', 'image' => 'uploads/news/OpAsDfGhJkLzXcVbNmQw.jpg'],
            ['title' => 'Dinner Eksklusif di Kapal Pesiar', 'description' => 'Pengalaman makan malam mewah di atas kapal pesiar dengan menu internasional.', 'image' => 'uploads/news/TrQwXyZaSdFgHjKlMnOp.jpg'],
            ['title' => 'Peluncuran Dessert Signature oleh Pastry Chef', 'description' => 'Pastry chef menghadirkan dessert signature dengan sentuhan seni plating.', 'image' => 'uploads/news/ZxCvBnMqWeRtYuIoPaSd.jpg'],
            ['title' => 'Restoran Fine Dining dengan Menu Seafood Premium', 'description' => 'Menu seafood premium menghadirkan lobster, king crab, dan oyster segar.', 'image' => 'uploads/news/DfGhJkLzXcVbNmQwErTy.jpg'],
            ['title' => 'Acara Wine Dinner Eksklusif di Jakarta', 'description' => 'Wine dinner menghadirkan pairing menu dengan koleksi wine vintage.', 'image' => 'uploads/news/KlMnOpQrStUvWxYzAbCd.jpg'],
            ['title' => 'Chef Competition Fine Dining', 'description' => 'Kompetisi chef menghadirkan kreasi kuliner fine dining terbaik.', 'image' => 'uploads/news/TrQwXyZaSdFgHjKlMnOp.jpg']
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
}

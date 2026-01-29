<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Import
use DB;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->delete();

        $products = [
            ['name' => 'Foie Gras Terrine', 'description' => 'Foie gras lembut disajikan dengan brioche panggang dan chutney buah ara.', 'price' => 450000, 'image' => 'uploads/products/aKJdPqW9LmNoRtYxZcVb.jpg'],
            ['name' => 'Beef Wellington', 'description' => 'Daging sapi premium dibalut puff pastry dengan saus red wine reduction.', 'price' => 650000, 'image' => 'uploads/products/GhIjKlMnOpQrStUvWxYz.jpg'],
            ['name' => 'Lobster Thermidor', 'description' => 'Lobster segar dengan saus krim mustard dan keju parmesan.', 'price' => 700000, 'image' => 'uploads/products/MnBvCxZaSdFgHjKlQwEr.jpg'],
            ['name' => 'Duck à l’Orange', 'description' => 'Bebek panggang dengan saus jeruk klasik Prancis.', 'price' => 550000, 'image' => 'uploads/products/QwErTyUiOpAsDfGhJkLz.jpg'],
            ['name' => 'Risotto Truffle', 'description' => 'Risotto creamy dengan aroma truffle hitam dan parmesan.', 'price' => 400000, 'image' => 'uploads/products/RtYuIoPaSdFgHjKlZxCv.jpg'],
            ['name' => 'Seared Scallops', 'description' => 'Scallop segar dipanggang dengan puree kembang kol dan saus beurre blanc.', 'price' => 480000, 'image' => 'uploads/products/XyZpQrStUvWxYzAbCdEf.jpg'],
            ['name' => 'Rack of Lamb', 'description' => 'Daging domba panggang dengan rosemary jus dan ratatouille.', 'price' => 600000, 'image' => 'uploads/products/aKJdPqW9LmNoRtYxZcVb.jpg'],
            ['name' => 'Salmon en Papillote', 'description' => 'Salmon panggang dalam kertas dengan sayuran dan lemon butter.', 'price' => 420000, 'image' => 'uploads/products/GhIjKlMnOpQrStUvWxYz.jpg'],
            ['name' => 'Caviar Blinis', 'description' => 'Caviar premium disajikan di atas blinis dengan crème fraîche.', 'price' => 750000, 'image' => 'uploads/products/QwErTyUiOpAsDfGhJkLz.jpg'],
            ['name' => 'Oxtail Consommé', 'description' => 'Sup bening ekor sapi dengan garnish sayuran halus.', 'price' => 350000, 'image' => 'uploads/products/RtYuIoPaSdFgHjKlZxCv.jpg'],
            ['name' => 'Tuna Tartare', 'description' => 'Tuna segar dengan avocado, sesame oil, dan soy dressing.', 'price' => 380000, 'image' => 'uploads/products/aKJdPqW9LmNoRtYxZcVb.jpg'],
            ['name' => 'Porcini Mushroom Soup', 'description' => 'Sup krim jamur porcini dengan truffle oil.', 'price' => 300000, 'image' => 'uploads/products/GhIjKlMnOpQrStUvWxYz.jpg'],
            ['name' => 'King Crab Ravioli', 'description' => 'Ravioli isi daging kepiting dengan saus saffron.', 'price' => 520000, 'image' => 'uploads/products/QwErTyUiOpAsDfGhJkLz.jpg'],
            ['name' => 'Wagyu Steak', 'description' => 'Steak wagyu A5 dengan saus black pepper dan mashed potato.', 'price' => 950000, 'image' => 'uploads/products/RtYuIoPaSdFgHjKlZxCv.jpg'],
            ['name' => 'Duck Confit', 'description' => 'Paha bebek dimasak perlahan dengan lemaknya, disajikan dengan lentil.', 'price' => 500000, 'image' => 'uploads/products/aKJdPqW9LmNoRtYxZcVb.jpg'],
            ['name' => 'Escargot Bourguignon', 'description' => 'Siput panggang dengan garlic butter dan parsley.', 'price' => 370000, 'image' => 'uploads/products/GhIjKlMnOpQrStUvWxYz.jpg'],
            ['name' => 'Veal Milanese', 'description' => 'Daging sapi muda breaded dengan lemon butter sauce.', 'price' => 580000, 'image' => 'uploads/products/QwErTyUiOpAsDfGhJkLz.jpg'],
            ['name' => 'Black Cod Miso', 'description' => 'Ikan cod premium dengan glaze miso khas Jepang.', 'price' => 620000, 'image' => 'uploads/products/RtYuIoPaSdFgHjKlZxCv.jpg'],
            ['name' => 'Beetroot Carpaccio', 'description' => 'Irisan tipis beetroot dengan goat cheese dan balsamic glaze.', 'price' => 280000, 'image' => 'uploads/products/aKJdPqW9LmNoRtYxZcVb.jpg'],
            ['name' => 'Chocolate Soufflé', 'description' => 'Soufflé cokelat lembut dengan vanilla ice cream.', 'price' => 320000, 'image' =>'uploads/products/MnBvCxZaSdFgHjKlQwEr.jpg'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

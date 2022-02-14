<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        Product::insert([
            [
                'titolo' => 'Lettiera per gatti',
                'descrizione' => 'Lettiera assorbente per gatto irriverente',
                'prezzo' => 20.50,
                'quantita' => 3
            ],[
                'titolo' => 'Macchina per PopCorn',
                'descrizione' => 'Bella macchina funzionale',
                'prezzo' => 49.99,
                'quantita' => 20,
            ]
        ]);
    }
}

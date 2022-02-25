<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Seller::truncate();
        Seller::insert([
            [
                'username' => 'venditore',
                'email' => 'venditore@gmail.com',
                'nome_negozio' => 'Il mio negozio'
            ],[
                'username' => 'venditore_2',
                'email' => 'venditore2@gmail.com',
                'nome_negozio' => 'Il mio negozio 2'
            ]
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

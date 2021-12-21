<?php

namespace Database\Seeders;

use App\Models\Pizza;
use DB;
use Google\Service\ServiceManagement\Control;
use Illuminate\Database\Seeder;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pizza::insert([
            [
                'nome_pizza' => 'Margherita',
                'tonno' => true,
                'olive' => true,
                'funghi' => true
            ],
            [
                'nome_pizza' => 'Capricciosa',
                'tonno' => false,
                'olive' => false,
                'funghi' => true
            ],
        ]);
    }
}

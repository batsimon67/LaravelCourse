<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::insert([
            [
                'name' => 'Ciccio',
                'email' => 'ciccio@pasticcio.com',
                'telefono' => '3182389012',
                'password' => 'prova',
                'eta' => 43
            ],[
                'name' => 'Mario',
                'email' => 'mario@rossi.com',
                'telefono' => '31823890212',
                'password' => 'provda',
                'eta' => 45
            ]
        ]);

        // Utilizzando la classe generica DB
        /*DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'name' => 'Ciccio',
                'email' => 'ciccio@pasticcio.com',
                'telefono' => '3182389012',
                'password' => 'prova',
                'eta' => 43
            ],
            [
                'name' => 'Pippo',
                'email' => 'pippo@franco.com',
                'eta' => 81,
                'password' => 'prova',
                'telefono' => '123812389'
            ]
        ]);*/
    }
}

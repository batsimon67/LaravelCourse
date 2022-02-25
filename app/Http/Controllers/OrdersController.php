<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Order::with('users')
            ->where('user_id', $id)
            ->get();
        return $orders;
    }

    public function consegna() {
        try {
            $string = 'CREARE UN\'ENTITÀ VENDITORE CON TUTTI I METODI CRUD';
            $string2 = 'CHE POSSIEDE PIÙ PRODOTTI';
            //tips:
            /*
             * php artisan make:migration create_NOMETABELLA_table
             * php artisan migrate
             * creazione model
             * creazione route
             * creazione controller
             */
            return $string.' '.$string2;
        } catch(\Exception $e) {
            return 'SONO UN\'INCAPACE';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //recupero dell'ordine
        $order = Order::with('users', 'products')->find($id);

        //recupero dei riferimento dell'utente e del prodotto dalle relazioni definite nel modello degli ordini
        $user = $order->users;
        $product = $order->products;

        $quantita = $order['quantita'];
        $prezzo = $order['prezzo'];

        //reincremento il credito dell'utente e la quantità del prodotto
        $user->credito += $prezzo;
        $product->quantita += $quantita;

        //salv
        $user->save();
        $product->save();
        $order->delete();
    }
}

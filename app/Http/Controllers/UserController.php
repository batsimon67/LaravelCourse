<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $search = request()->get('search');
        $users = User::with('orders')
            ->where('name', 'LIKE', '%'.$search.'%')
            ->get();
        return $users;
    }

    public function store(Request $request)
    {
        $data = $request->get('data');
        $user = User::firstOrCreate(["email" => $data['email']]);
        return $user;
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $user = User::find($id);
        $user->fill($data)->save();
        return $user;
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function getProductsDetails($user_id) {
        $results = User::find($user_id)
            ->with('orders.products')
            ->first();
        return $results;
    }

    public function checkIfBuyedProduct(Request $request) {
        try {
            $data = $request->input();
            $risultato = User::with(['ordersByProductId' => function($query) use ($data) {
                $query->where('user_id', $data['user_id'])
                    ->where('product_id', $data['product_id']);
            }])
                ->get();
            return $risultato;
        } catch (\Exception $e){
            return "ERRORE".$e->getFile().$e->getMessage().$e->getLine();
        }
    }

    public function effettuaOrdine(Request $request) {
        try {
            //inizio della transazione con il Database, permette di annullare le modifiche sulle tabelle
            DB::beginTransaction();
            $data = $request->get('data');
            $user_id = $data['user_id'];
            $product_id = $data['product_id'];

            //recupero prodotto
            $prodotto = Product::find($product_id);
            //controllo se la quantità del prodotto è disponibile nel database
            if ($prodotto->quantita < $data['quantita'])
                return 'Errore, quantità mancante';
            //decremento la quantità del prodotto rispetto a quella richiesta dall'utente
            $prodotto['quantita'] = $prodotto->quantita - $data['quantita'];
            $prodotto->save();

            //recupero utente
            $user = User::find($user_id);
            //controllo se l'utente ha abbastanza credito per poter effettuare l'ordine
            if ($user->credito < (intval($data['quantita']) * floatval($prodotto->prezzo)))
                return 'Errore, fondi mancanti';
            //aggiorno il credito dell'utente decrementandolo rispetto al prezzo e alla quantità del prodotto acquistato
            $user['credito'] = $user['credito'] - ($prodotto->prezzo * $data['quantita']) - $data['costo_spedizione'];
            $user->save();

            $data['prezzo'] = $prodotto->prezzo * $data['quantita'];
            //salvo il nuovo ordine
            $orders = new Order($data);
            $orders->save();

            //salvo le modifiche sul database
            DB::commit();
            return 'Ordine creato con successo!';
        } catch(\Exception $e) {
            //annullo le modifiche sul database
            DB::rollBack();
            return 'Errore! '. $e->getMessage();
        }
    }

    public function getMessages($user_id, $seller_id) {
        $msg = Message::where('user_id', $user_id)
            ->where('seller_id', $seller_id)
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Messaggi recuperati correttamente!',
            'result' => $msg
        ], 200);

    }

}

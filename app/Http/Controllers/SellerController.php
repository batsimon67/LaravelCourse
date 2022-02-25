<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $seller = Seller::with('products');
            $seller_get = $seller->get();
            $count = $seller->count();

            return response()->json([
                'status' => true,
                'message' => 'Venditori recuperati con successo!',
                'count' => $count,
                'sellers' => $seller_get
            ], 200);
        } catch(QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'error' => 'Errore nel recupero dei venditori dal database!'
            ], 500);
        } catch(\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error' => 'Errore nel recupero dei venditori!'
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Seller
     */
    public function store(Request $request)
    {
        $data = $request->get('data');
        $seller = new Seller($data);
        $seller->save();
        return $seller;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Seller::find($id);
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
        $data = $request->get('data');
        $seller = Seller::find($id);
        $seller->fill($data)->save();
        return $seller;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id)
    {
        return Seller::destroy($id);
    }
}

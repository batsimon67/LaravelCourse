<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $data = $request->get('data');
        $product = new Product($data);
        $product->save();
        return $product;
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $product = Product::find($id);
        $product->fill($data)->save();
        return $product;
    }

    public function destroy($id)
    {
        return Product::destroy($id);
    }

    public function getAllBuyers($id) {
        $result = Product::where('product_id', $id)->with('orders.users')->get();
    }
}

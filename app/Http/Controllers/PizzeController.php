<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\User;
use Illuminate\Http\Request;

class PizzeController extends Controller
{
    public function index()
    {
        $pizze = Pizza::withTrashed()->get();
        return $pizze;
    }


    public function store(Request $request)
    {
        $data = $request->get('data');
        $pizza = new Pizza($data);
        $pizza->save();

        return $pizza;
    }


    public function show($id)
    {

    }


    public function update(Request $request, $id)
    {
        $data = $request->get('ingredienti');
        $pizza = Pizza::find($id);
        $pizza->fill($data)->save();
    }


    public function destroy($id)
    {
        return Pizza::destroy($id);
    }
}

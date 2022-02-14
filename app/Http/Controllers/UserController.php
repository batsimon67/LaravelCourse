<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $search = request()->get('search');
        $users = User::where('name', 'LIKE', '%'.$search.'%')->get();
        return $users;
    }

    public function store(Request $request)
    {
        $data = $request->get('data');
        $user = User::firstOrCreate(["email" => $data['email']], $data);
        /*$user = new User($data);
        $user->save();*/
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
}

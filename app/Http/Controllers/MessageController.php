<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request) {
        $data = $request->get('data');
        $msg = new Message($data);
        $msg->save();
        return response()->json([
            'status' => true,
            'message' => 'Messaggio inoltrato correttamente!',
            'result' => $msg
        ], 200);
    }
}

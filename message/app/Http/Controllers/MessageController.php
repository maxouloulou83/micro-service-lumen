<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller {

    public function index() {
        $messages = Message::all();
        return response()->json($messages);
    }

    public function show($id) {
        $message = Message::find($id);
        return response()->json($message);
    }

    public function create(Request $request) {
        $message = new Message();

        $message->name = $request->name;
        $message->message = $request->message;

        $message->save();

        return response()->json("message bien créer");
    }

    public function uptade(Request $request, $id) {
        $message = Message::find($id);

        $message->name = $request->name;
        $message->message = $request->message;

        $message->save();

        return response()->json("message bien modifié");
    }

    public function delete($id) {
        $message = Message::find($id);
        $message->delete();

        return response()->json("message bien supprimé");
    }
}


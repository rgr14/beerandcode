<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SignatureController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'drink' => 'required|string'
        ]);

        $params = $validator->fails() ? $validator->messages() : $validator->validated()['drink'];

        $user = auth()->user();
        $name = $user->name;
        $document = $user->client->document;
        $status = $user->client->signatures->first()->status->name;

        return view('teste', [
            'name' => $name,
            'document' => $document,
            'status' => $status,
            'params' => $params
        ]);
    }
}

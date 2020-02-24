<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function create() {
        return response()->json(['message' => 'connected']);
    }
}

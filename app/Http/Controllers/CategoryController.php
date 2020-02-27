<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function all() {
    $categories = Category::all();

    if(is_null($categories))
      return response()->json(["message" => "Internal server error"], 505);
    
    return response()->json(["categories" => $categories], 200);
  }

  public function register()
  {
    // $data = "teste-fernando-minhasenha-1234-5678";
    // return response()->json(["response" => $data], 200);
    
    $data = [
      "key" => "teste",
      "id" => "fernando",
      "senha" => "minhasenha",
      "time" => time(),
      "expire" => time() * 10
    ];

    $encode_string = "{$data['key']}.{$data['id']}.{$data['senha']}.{$data['time']}.{$data['expire']}";

    $encoded = base64_encode($encode_string);
    $decoded = base64_decode($encoded);

    return response()->json([
      "encoded" => $encoded,
      "decoded" => $decoded,
      "data" => $encode_string,
    ], 200);
  }
}

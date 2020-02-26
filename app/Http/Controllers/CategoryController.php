<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
  public function all() {
    $categories = Category::all();

    if(is_null($categories))
      return response()->json(["message" => "Internal server error"], 505);
    
    return response()->json(["categories" => $categories], 200);
  }
}

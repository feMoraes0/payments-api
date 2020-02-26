<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Payment;
use App\User;

class PaymentController extends Controller
{
  private $payment;
  
  public function __construct()
  {
    $this->payment = new Payment();
  }

  public function store(Request $request)
  {
    $this->validate($request, $this->payment->rules, $this->payment->messages);

    $user = User::find($request->user_id);

    if(is_null($user))
      return response()->json(["message" => "User not found."], 404);

    $category = Category::find($request->category_id);

    if(is_null($category))
      return response()->json(["message" => "Category not found."], 404);
    
    $payment = $this->payment->create($request->all());

    return response()->json(
      [
        "payment" => $payment
      ],
      200
    );
  }
}

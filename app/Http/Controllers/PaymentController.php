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

  public function index($user_id, $id)
  {
    $payment = $this->payment->find($user_id, $id);

    if(!$payment)
      return response()->json(["message" => "Payment not found."], 404);
    
    $category = Category::find($payment->category_id);
    
    unset($payment->category_id);

    $payment->category = $category;
    
    return response()->json(["payment" => $payment], 200);
  }

  public function store(Request $request, $user_id)
  {
    $this->validate($request, $this->payment->rules, $this->payment->messages);

    $user = User::find($user_id);

    if(is_null($user))
      return response()->json(["message" => "User not found."], 404);

    $category = Category::find($request->category_id);

    if(is_null($category))
      return response()->json(["message" => "Category not found."], 404);

    $request["user_id"] = intval($user_id);
    
    $payment = $this->payment->create($request->all());

    unset($payment->category_id);

    $payment->category = $category;

    return response()->json(["payment" => $payment], 201);
  }

  public function update(Request $request, $user_id, $id)
  {
    $this->validate(
      $request,
      $this->payment->rules,
      $this->payment->messages
    );

    $payment = $this->payment->find($user_id, $id);

    if(is_null($payment))
      return response()->json(["message" => "Payment not found."], 404);
    
    $category = Category::find($request->category_id);

    if(is_null($category))
      return response()->json(["message" => "Category not found."], 404);
    
    $payment->category_id = $request->category_id;
    $payment->amount = $request->amount;
    $payment->label = $request->label;

    $payment->update();

    unset($payment->category_id);

    $payment->category = $category;

    return response()->json(["payment" => $payment], 200);
  }

  public function delete($user_id, $id)
  {
    $payment = $this->payment->find($user_id, $id);

    if(is_null($payment))
      return response()->json(["message" => "Payment not found"], 404);
    
    if($payment->delete())
      return response()->json(["message" => "Deleted with success", "payment" => $payment], 200);
    
    return response()->json(["message" => "Fail to delete, try again later"], 505);
  }
}

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

  public function index($id)
  {
    $payment = $this->payment->find($id);
    
    if($payment)
      return response()->json(["payment" => $payment], 200);

    return response()->json(["message" => "Payment not found."], 404);
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

    return response()->json(["payment" => $payment], 201);
  }

  public function update(Request $request, $id)
  {
    $this->validate(
      $request,
      [
        "category_id" => "required",
        "amount" => "required",
        "label" => "required"
      ],
      $this->payment->messages
    );

    $payment = $this->payment->find($id);

    if(is_null($payment))
      return response()->json(["message" => "Payment not found."], 404);
    
    $category = Category::find($request->category_id);

    if(is_null($category))
      return response()->json(["message" => "Category not found."], 404);
    
    $payment->category_id = $request->category_id;
    $payment->amount = $request->amount;
    $payment->label = $request->label;

    $payment->update();

    return response()->json(["payment" => $payment], 200);
  }

  public function delete($id)
  {
    $payment = $this->payment->find($id);

    if(is_null($payment))
      return response()->json(["message" => "Payment not found"], 404);
    
    if($payment->delete())
      return response()->json(["message" => "Deleted with success"], 200);
    
    return response()->json(["message" => "Fail to delete, try again later"], 505);
  }
}

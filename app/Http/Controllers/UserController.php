<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  private $user;

  public function __construct()
  {
    $this->user = new User();
  }

  public function index($id)
  {
    $data = $this->user->find($id);
    return response()->json(["user" => $data], 200);
  }

  public function store(Request $request)
  {
    $this->validate(
      $request,
      $this->user->rules,
      $this->user->messages
    );
    $saved = $this->user->create($request->all());
    return response()->json(["user" => $saved], 201);
  }

  public function update(Request $request, $id)
  {
    $new_user = $this->user->find($id);
    if($new_user == null)
      return response()->json(["message" => "User not found"], 404);
    
    if($request->name != null)
      $new_user->name = $request->name;
    if($request->email != null)
      $new_user->email = $request->email;
    if($request->password != null)
      $new_user->password = $request->password;
    
    $new_user->update();
    return response()->json(["user" => $new_user], 200);
  }
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $user = new User();

    $this->validate($request, $user->rules, $user->messages);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = hash("sha256", $request->password);

    $saved_user = $user->save();

    if(!$saved_user)
      return response()->json(["message" => "Internal server error"], 505);
    
    $auth = new Auth();
    $token = $auth->generateToken($user->id);

    return response()->json(["token" => $token, "user" => $user], 201);
  }

  public function login(Request $request)
  {
    $user = new User();

    $this->validate(
      $request,
      [
        "email" => "required",
        "password" => "required"
      ],
      $user->messages
    );

    $user->email = $request->email;
    $user->password = hash("sha256", $request->password);

    $db_user = $user->where([
      ["email", "=", $user->email],
      ["password", "=", $user->password]
    ])->first();

    if(is_null($db_user))
      return response()->json(["message" => "User not found."], 404);
    
    $auth = new Auth();
    $token = $auth->generateToken($user->id);

    return response()->json(["token" => $token, "user" => $db_user], 201);
  }
}

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

  public function index($id) {
    $data = $this->user->find($id);
    return response()->json(["user" => $data], 200);
  }

  public function create(Request $request)
  {
    $this->validate(
      $request,
      $this->user->rules,
      $this->user->messages
    );
    $saved = $this->user->create($request->all());
    return response()->json(
      [
        "user"    => $saved,
      ],
      201
    );
  }
}

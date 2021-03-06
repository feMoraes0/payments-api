<?php

namespace App\Http\Middleware;

use App\Auth;
use Closure;

class AuthMiddleware
{
  /**
   * Run the request filter.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    try {
      $user_requested = $request->route('user_id');
      $auth = new Auth();

      if(!$request->header("authorization"))
        return response()->json(["message" => "Header authorization field is required."], 400);
      
      $token = $request->header("authorization");
      
      $validate = $auth->validate($token);

      if($validate["code"] == 200)
      {
        if($validate["code"] == $user_requested)
          return $next($request);
        return response()->json(["message" => "User and token does not match."], 400);
      }

      return response()->json(["message" => $validate["message"]], $validate["code"]);

    } catch (\Throwable $th)
    {
      return response()->json(["message" => "Internal server error"], 505);
    }
  }
}

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
      $auth = new Auth();

      if(!$request->header("authorization"))
        return response()->json(["message" => "Header authorization field is required."], 400);
      
      $token = $request->header("authorization");
      
      $validate = $auth->validate($token);

      if($validate["code"] == 200)
      {
        $request->user_id = $validate["code"];
      
        return $next($request);
      }

      return response()->json(["message" => $validate["message"]], $validate["code"]);

    } catch (\Throwable $th)
    {
      return response()->json(["message" => "Internal server error"], 505);
    }
  }
}

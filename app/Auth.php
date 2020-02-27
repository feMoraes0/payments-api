<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
  public function validate($authentication)
  {
    try
    {
      $token = explode(" ", $authentication);

      if($token[0] != "Bearer")
        return [
          "message" => "Invalid token",
          "code" => 401
        ];

      $parts = explode(".", $token[1]);
      $header = base64_decode($parts[0]);
      $payload = base64_decode($parts[1]);
      $signature = base64_decode($parts[2]);

      $payload_data = explode(".", $payload);
      $user_id = $payload_data[0];

      $key = env("SECRET");

      $local_signature = hash($header, "{$key}.{$user_id}");

      if($local_signature == $signature)
      {
        $now = time();
        $start = $payload_data[1];
        $end = $payload_data[2];

        if(intval($start) <= $now && intval($end) >= $now)
          return [
            "message" => "success",
            "user_id" => $user_id,
            "code" => 200,
          ];
        
        return [
          "message" => "Token expired",
          "code" => 401
        ];
      }

      return [
        "message" => "Invalid token",
        "code" => 401
      ];
    }
    catch(Exception $e)
    {
      return [
        "token" => $token,
        "message" => "Fail to verify token",
        "code" => 505
      ];
    }
  }

  public function generateToken($user_id)
  {
    $now = time();
    $expires = $now * 60 * 3;
    $key = env("SECRET");

    $header = base64_encode("sha256"); // cwt = custom web token
    $payload = base64_encode("{$user_id}.{$now}.{$expires}");
    $signature = base64_encode(hash("sha256", "{$key}.{$user_id}"));
    
    return "{$header}.{$payload}.{$signature}";
  }
}

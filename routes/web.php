<?php
/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/
$router->group(["prefix" => "user"], function () use ($router)
{
  /*
  |--------------------------------------------------------------------------
  | User Routes
  |--------------------------------------------------------------------------
  */
  $router->post("", "UserController@store");
  $router->get("{id}", "UserController@index");
  $router->put("{id}", "UserController@update");
  $router->delete("{id}", "UserController@delete");
  /*
  |--------------------------------------------------------------------------
  | User Payment Routes
  |--------------------------------------------------------------------------
  */
  $router->group(["prefix" => "{user_id}/payment"], function () use ($router)
  {
    $router->post("", "PaymentController@store");
    $router->get("{id}", "PaymentController@index");
    $router->put("{id}", "PaymentController@update");
    $router->delete("{id}", "PaymentController@delete");
  });
});

$router->get("/categories", "CategoryController@all");
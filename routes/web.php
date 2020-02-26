<?php
/*
 |--------------------------------------------------------------------------
 | User Routes
 |--------------------------------------------------------------------------
 */
$router->post("/user", "UserController@store");
$router->get("/user/{id}", "UserController@index");
$router->put("/user/{id}", "UserController@update");
$router->delete("/user/{id}", "UserController@delete");

/*
 |--------------------------------------------------------------------------
 | Payments Routes
 |--------------------------------------------------------------------------
 */
$router->post("/payment", "PaymentController@store");
$router->get("/payment/{id}", "PaymentController@index");
$router->put("/payment/{id}", "PaymentController@update");
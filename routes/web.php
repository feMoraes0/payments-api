<?php
/*
 |--------------------------------------------------------------------------
 | User Routes
 |--------------------------------------------------------------------------
 */
$router->post("/user", "UserController@store");
$router->get("/user/{id}", "UserController@index");
$router->put("/user/{id}", "UserController@update");

<?php
/*
 |--------------------------------------------------------------------------
 | User Routes
 |--------------------------------------------------------------------------
 */
$router->post("/user/create", "UserController@create");
$router->get("/user/{id}", "UserController@index");

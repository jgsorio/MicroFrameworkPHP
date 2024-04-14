<?php

$router = [];

$router[] = ["GET", "/", "HomeController@index"];
$router[] = ["GET", "/users/{id}", "UserController@show"];

return $router;
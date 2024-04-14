<?php

use App\Classes\Router;

require_once __DIR__ . '/vendor/autoload.php';
$routes = require_once 'routes.php';
try {
    $router = new Router($routes);
} catch (Exception $e) {
    dd($e->getMessage());
}

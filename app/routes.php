<?php


$route = new Core\Router;


$route->setRoute('/', 'GET', '', ['App\Controllers\HomeController', 'dump']);
$route->setRoute('/api/v1/send/:id/:name', 'GET', 'App\Http\Middlewares\Valid::cheked', ['App\Http\Controllers\HomeController', 'index']);
$route->setRoute('/rutas', 'POST', '', ['App\Http\Controllers\HomeController', 'index']);
$route->setRoute('/dump', 'POST', '', ['App\Http\Controllers\HomeController', 'dump']);
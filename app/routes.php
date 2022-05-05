<?php


$route = new Core\Router;


$route->setRoute('/', 'GET', '', ['App\Controllers\HomeController', 'dump']);
$route->setRoute('/api/v1/send/:id/:name', 'GET', 'App\Http\Middlewares\Valid::cheked', ['App\Http\Controllers\HomeController', 'index']);
$route->setRoute('/rutas', 'POST', '', ['App\Http\Controllers\HomeController', 'index']);
$route->setRoute('/dump', 'POST', '', ['App\Http\Controllers\HomeController', 'dump']);

$route->setGroup('/v1/produccion/test', 'pass', function ($route) {
    $route->setGroupRoute('/exist/:name', 'POST', '', ['App\Http\Controllers\HomeController', 'index']);
    $route->setGroupRoute('/add/:name', 'POST', '', ['App\Http\Controllers\HomeController', 'index']);
    $route->setGroupRoute('/remoive/:name', 'POST', '', ['App\Http\Controllers\HomeController', 'index']);
});
$route->setGroup('/v2/develop/test', '', function ($route) {
    $route->setGroupRoute('/exist/:name', 'POST', '', ['App\Http\Controllers\HomeController', 'index']);
    $route->setGroupRoute('/add/:name', 'POST', '', ['App\Http\Controllers\HomeController', 'index']);
    $route->setGroupRoute('/remoive/:name', 'POST', '', ['App\Http\Controllers\HomeController', 'index']);
});
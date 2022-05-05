<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST");
date_default_timezone_set('America/Mexico_City');
require '../vendor/autoload.php';
require '../app/routes.php';
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// echo json_encode($route->getRoutes());
$app = new Core\Core($route->getRoutes());
$app->send();


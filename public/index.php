<?php

require_once __DIR__.'/../vendor/autoload.php';
use App\Core\Application;


$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');

$app->router->get('/contact', [App\Controllers\ExampleController::class, 'view']);
$app->router->post('/contact', [App\Controllers\ExampleController::class, 'handleData']); 

$app->router->get('/login', [App\Controllers\AuthController::class, 'login']);
$app->router->post('/login', [App\Controllers\AuthController::class, 'login']); 

$app->router->get('/register', [App\Controllers\AuthController::class, 'register']);
$app->router->post('/register', [App\Controllers\AuthController::class, 'register']); 

$app->run();
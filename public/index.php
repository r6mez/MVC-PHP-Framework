<?php

use Ramez\PhpMvcCore\Application;
use App\Controllers\AuthController;

require_once __DIR__.'/../vendor/autoload.php';

$rootPath = dirname(__DIR__);

$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();


$config = [
    'userClass' => \App\Models\RegisterModel::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];


$app = new Application($rootPath, $config);

$app->router->get('/', 'home');

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']); 

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']); 

$app->router->get('/logout', [AuthController::class, 'logout']); 

$app->router->get('/profile', [AuthController::class, 'profile']); 

$app->run();
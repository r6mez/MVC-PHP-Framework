<?php


use App\Core\Application;

require_once __DIR__.'/../vendor/autoload.php';

$rootPath = dirname(__DIR__);

$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();


$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];


$app = new Application($rootPath, $config);

$app->router->get('/', 'home');

$app->router->get('/contact', [App\Controllers\ExampleController::class, 'view']);
$app->router->post('/contact', [App\Controllers\ExampleController::class, 'handleData']); 

$app->router->get('/login', [App\Controllers\AuthController::class, 'login']);
$app->router->post('/login', [App\Controllers\AuthController::class, 'login']); 

$app->router->get('/register', [App\Controllers\AuthController::class, 'register']);
$app->router->post('/register', [App\Controllers\AuthController::class, 'register']); 

$app->run();
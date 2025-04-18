<?php

namespace App\Core;

class Application {
    public static Application $app; // to access this instance globally
    public static string $ROOT_DIR;

    public Router $router;
    public Request $request;
    public Response $response;
    public Database $database;
    public Session $session;
    public Controller $controller;

    public function __construct($rootPath, array $config) {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->controller = new Controller();
        $this->session = new Session();
        $this->database = new Database($config['db']);
        $this->router = new Router($this->request, $this->response);
    }

    public function run(){
        echo $this->router->resolve();
    }
}
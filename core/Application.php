<?php

namespace App\Core;

use App\Models\UserModel;

class Application {
    public static Application $app; // to access this instance globally
    public static string $ROOT_DIR;

    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $database;
    public Session $session;
    public Controller $controller;
    public ?UserModel $user = null; // Initialize to null
    public View $view;

    public function __construct($rootPath, array $config) {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->userClass = $config["userClass"];
        $this->request = new Request();
        $this->response = new Response();
        $this->controller = new Controller();
        $this->session = new Session();
        $this->database = new Database($config['db']);
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
        
        $idValue = $this->session->get("user");
        
        if($idValue){
            $id = $this->userClass::id();
            $this->user = $this->userClass::findOne([$id => $idValue]); // assign to $this->user
        } else {
            $this->user = null;
        }
    }

    public function run(){
        try{
            echo $this->router->resolve();
        } catch (\Exception $e) {
            echo $this->view->renderView('error', ['exception' => $e]);
        }
    }

    public function login($user){
        $this->user = $user;
        $id = $user::id();
        $idValue = $user->{$id};
        $this->session->set("user", $idValue); // store the actual id value
        return true;
    }

    public function logout(){
        $this->user = null;
        $this->session->remove("user");
    }

    public static function isGuest(){
        if(!self::$app->user) return true;
        else return false;
    }
}
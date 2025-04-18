<?php 

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\LoginForm;
use App\Models\LoginModel;
use App\Models\RegisterModel;
use App\Models\User;

class AuthController extends Controller {
    public function __construct() {
        $this->setLayout('auth');
    }

    public function register(Request $request){
        $user = new RegisterModel();
        if($request->isPost()){
            $user->loadData($request->getBody());
            
            if($user->validate() && $user->put()){
                Application::$app->session->setFlash("success", "You have registered in successfully !");
                Application::$app->response->redirect('/');
            }   

            return $this->render('register', ['model' => $user]);
        }

        return $this->render('register', ['model' => $user]);
    }

    public function login(Request $request, Response $response){
        $loginModel = new LoginModel();

        if($request->isPost()){
            $loginModel->loadData($request->getBody());
            
            if($loginModel->validate() && $loginModel->login()){
                $response->redirect('/');
            }   

            return $this->render('login', ['model' => $loginModel]);
        }

        return $this->render('login', ['model' => $loginModel]);
    }

    public function logout(Request $request, Response $response){
        Application::$app->logout();
        $response->redirect('/');
    }
}
<?php 

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;
use App\Models\LoginModel;
use App\Models\User;

class AuthController extends Controller {
    public function __construct() {
        $this->setLayout('auth');
    }

    public function register(Request $request){
        $user = new User();
        if($request->isPost()){
            $user->loadData($request->getBody());
            
            if($user->validate() && $user->put()){
                Application::$app->session->setFlash("success", "You have loggend in successfully !");
                Application::$app->response->redirect('/');
            }   

            return $this->render('register', ['model' => $user]);
        }

        return $this->render('register', ['model' => $user]);
    }

    public function login(Request $request){
        $loginModel = new LoginModel();
        if($request->isPost()){
            $loginModel->loadData($request->getBody());
            
            if($loginModel->validate() && $loginModel->login()){
                return 'success !';
            }   

            return $this->render('login', ['model' => $loginModel]);
        }

        return $this->render('login', ['model' => $loginModel]);
    }
}
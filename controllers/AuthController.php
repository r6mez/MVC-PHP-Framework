<?php 

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\LoginModel;
use App\Models\RegisterModel;

class AuthController extends Controller {
    public function __construct() {
        $this->setLayout('auth');
    }

    public function register(Request $request){
        $registerModel = new RegisterModel();
        if($request->isPost()){
            $registerModel->loadData($request->getBody());
            
            if($registerModel->validate() && $registerModel->register()){
                return 'success !';
            }   

            return $this->render('register', ['model' => $registerModel]);
        }

        return $this->render('register', ['model' => $registerModel]);
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
<?php
namespace App\Models;

use Ramez\PhpMvcCore\Model;
use Ramez\PhpMvcCore\Application;

class LoginModel extends Model {
    public string $email = "";
    public string $password = "";
  
    public function tableName(): string {
        return 'users';
    }
    
    
    public function attributes(): array {
        return ['email', 'password'];
    }
 
    public function labels(): array {
        return [
            'email' => 'Your Email address',
            'password' => 'Password'
        ];
    }
    
    public function rules(): array {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [
                self::RULE_REQUIRED, 
                [self::RULE_MIN, 'min' => 8], 
                [self::RULE_MAX, 'max' => 24]
            ],
        ];
    }

    public function login(){
        $user = RegisterModel::getOne(['email' => $this->email]);

        return Application::$app->login($user);
    }
}
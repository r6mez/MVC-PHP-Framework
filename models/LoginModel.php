<?php
namespace App\Models;

use App\Core\Model;

class LoginModel extends Model {
    public string $email = "";
    public string $password = "";
  
    public function login(){
        echo 'Creating New Users';
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
}
<?php
namespace App\Models;

use Ramez\PhpMvcCore\DatabaseModel;

class RegisterModel extends UserModel {
    public string $name = "";
    public string $email = "";
    public string $password = "";
    public string $confirmPassword = "";

    public static function tableName(): string {
        return 'users';
    }
    
    public static function id() : string {
        return "id";
    }
    
    public function attributes(): array {
        return ['name', 'email', 'password'];
    }
    
    public function labels(): array {
        return [
            'name' => "Full Name",
            "email" => "Email Address",
            "password" => "Password",
            "confirmPassword" => "Confirm Password",
        ];
    }
    
    public function rules(): array {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
                [self::RULE_UNIQUE, 'class' => self::class]
            ],
            'password' => [
                self::RULE_REQUIRED, 
                [self::RULE_MIN, 'min' => 8], 
                [self::RULE_MAX, 'max' => 24]
            ],
            'confirmPassword' => [
                self::RULE_REQUIRED, 
                [self::RULE_MATCH, 'match' => 'password']
            ],
        ];
    }

    public function put(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::put();
    }

    public static function findOne(array $where) {
        return self::getOne($where);
    }

    public function getDisplayName(): string {
        return $this->name;
    }
}
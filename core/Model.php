<?php

namespace App\Core;

abstract class Model {
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';
    public const RULE_EXIST = 'exist';

    public array $errorMessages = [
        self::RULE_REQUIRED => 'This field is required ',
        self::RULE_EMAIL => 'This field must be a vaild email address',
        self::RULE_MIN => 'Min length of this field must be {min}',
        self::RULE_MAX => 'Max length of this filed must be {max}',
        self::RULE_MATCH => 'This field must match {match}',
        self::RULE_UNIQUE => 'Record with this {field} already exist',
        self::RULE_EXIST => 'There is no record with this {field}'
    ];

    public function loadData($data){
        foreach($data as $key => $value){
            if(property_exists($this, $key)){
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function labels() : array {
        return [];
    }
 
    public function getlabel($attribute){
        return $this->labels()[$attribute] ?? $attribute;
    }

    public array $errors = [];

    public function  validate(){
        foreach($this->rules() as $attribute => $rules){
            $value = $this->{$attribute};
            foreach($rules as $rule){
                $ruleName = $rule;
                if(!is_string($rule)){
                    $ruleName = $rule[0];
                }

                if($ruleName === self::RULE_REQUIRED && !$value){
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }

                if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }

                if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']){
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }

                if($ruleName === self::RULE_MAX && strlen($value) > $rule['max']){
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }

                if($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}){
                    $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
                }

                if($ruleName === self::RULE_UNIQUE){
                    $className = $rule['class'];
                    $uniqueAttribute = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Application::$app->database->prepare("SELECT * FROM $tableName WHERE $uniqueAttribute = :$uniqueAttribute");
                    $statement->bindValue(":$uniqueAttribute", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if($record){
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => strtolower($this->getlabel($attribute))]);
                    }
                }

                if($ruleName === self::RULE_EXIST){
                    $className = $rule['class'];
                    $uniqueAttribute = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Application::$app->database->prepare("SELECT * FROM $tableName WHERE $uniqueAttribute = :$uniqueAttribute");
                    $statement->bindValue(":$uniqueAttribute", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if(!$record){
                        $this->addErrorForRule($attribute, self::RULE_EXIST, ['field' => strtolower($this->getlabel($attribute))]);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function addErrorForRule(string $attribute, string $rule, array $params = []){
        $message = $this->errorMessages[$rule] ?? '';
        foreach($params as $key => $value){
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function hasError($attribute) {
        return $this->errors[$attribute] ?? false;
    }

    public function getErrorMessage($attribute){
        return $this->errors[$attribute][0];
    }
}
<?php

namespace App\Core;

abstract class DatabaseModel extends Model {
    abstract public static function tableName(): string;
    abstract public function attributes(): array;
    abstract public static function id(): string;

    public static function prepare($sql) {
        return Application::$app->database->pdo->prepare($sql);
    }

    public function put(){
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (". implode(',', $attributes) .") VALUES (". implode(',', $params) .");");
        foreach($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }
    
    public static function getOne(array $where){ // ["email" => "asd", "name" => "zzz"]
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $whereSQL = implode("AND ", array_map(fn($attribute) => "$attribute = :$attribute", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $whereSQL");
        foreach($where as $key => $item){
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
}
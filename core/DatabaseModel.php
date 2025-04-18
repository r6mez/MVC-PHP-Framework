<?php

namespace App\Core;

abstract class DatabaseModel extends Model {
    abstract public function tableName(): string;
    abstract public function attributes(): array;

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
    
    public function prepare($sql) {
        return Application::$app->database->pdo->prepare($sql);
    }
}
<?php

class m0001_initial {
    public function up(){
        $db = \App\Core\Application::$app->database;
        $SQL = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                status TINYINT DEFAULT 0,
                password VARCHAR(512) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down(){
        $db = \App\Core\Application::$app->database;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
    }
}
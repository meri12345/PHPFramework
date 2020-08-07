<?php

class m0002_add_pass_coloumn{
    public function up(){
        $db = \app\core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR (1028) NOT NULL");
    }

    public function down(){
        $db = \app\core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users DROP COLUMN password");
    }
}

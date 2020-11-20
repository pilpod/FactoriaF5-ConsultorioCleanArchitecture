<?php

namespace App\Infrastructure\DB;

use PDO;
use PDOException;

class Database
{

    public $mysql;

    public function __construct()
    {
        try {
            $this->mysql = $this->getConnection();
           
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    private function getConnection()
    {
        $data = file_get_contents("../src/DbConnection.json");
        $data = json_decode($data, true);

        $host = $data['myapp']['master']['hosts'];
        $user = $data['myapp']['master']['user'];
        $pass = $data['myapp']['master']['password'];
        $dbname = $data['myapp']['master']['dbname'];
        $charset = "utf-8";
        $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
        $pdo = new pdo("mysql:host={$host};dbname={$dbname};charset{$charset}", $user, $pass, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM `students_db`";
        return $pdo;
    }
}

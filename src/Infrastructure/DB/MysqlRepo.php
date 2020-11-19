<?php 

namespace App\Infrastructure\DB;

use App\Infrastructure\DB\Database;
use App\Domain\Contracts\IRepositories;
use App\Domain\Models\Coder;

class MysqlRepo implements IRepositories {

    private $database;
    private $table = "students_db";

    public function __construct()
    {
        if (!$this->database) {
            $this->database = new Database();
        }
    }

    public function findById($id)
    {
        
        $query = $this->database->mysql->query("SELECT * FROM `students_db` WHERE `id` = {$id}");
        $result = $query->fetchAll();

        return new Coder($result[0]["name"], $result[0]["subject"], $result[0]["id"], $result[0]["created_at"]);
    }

    public function findLastCoder()
    {
        $query = $this->database->mysql->query("SELECT * FROM `students_db` WHERE id=(SELECT max(id) FROM `students_db`)");
        $result = $query->fetchAll();
        return new self($result[0]["name"], $result[0]["subject"], $result[0]["id"], $result[0]["created_at"]);
    }

    public function deleteCoder(Coder $coder)
    {
        $query = $this->database->mysql->query("DELETE FROM `students_db` WHERE `students_db`.`id` = {$coder->getId()}");
    }

    public function saveCoder(Coder $coder)
    {
        $this->database->mysql->query("INSERT INTO `{$this->table}` (`name`, `subject`) VALUES ('{$coder->getName()}', '{$coder->getSubject()}');");
    }

    public function listAllCoders()
    {
        $query = $this->database->mysql->query("select * FROM students_db");
        $codersArray = $query->fetchAll();
        $codersList = [];

        foreach ($codersArray as $coder) {
            $coderItem = new Coder($coder["name"], $coder["subject"], $coder["id"], $coder["created_at"]);
            array_push($codersList, $coderItem);
        }

        return $codersList;
    }

    public function updateDataCoder(Coder $coder)
    {
        var_dump($coder->getName());
        $this->database->mysql->query("
            UPDATE `students_db` 
            SET `name` = '{$coder->getName()}', `subject` = '{$coder->getSubject()}' 
            WHERE `id` = {$coder->getId()}"
        ); 
    }

}

?>
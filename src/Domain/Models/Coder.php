<?php


namespace App\Domain\Models;


use App\Infrastructure\DB\Database;

class Coder
{
    private ?int $id; 
    private string $name;
    private string $subject;
    private ?string $created_at;
    private $database;
    private $table = "students_db";

    public function __construct(string $name = '', string $subject = '', int $id = null, string $created_at = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->subject = $subject;
        $this->created_at = $created_at;

        if (!$this->database) {
            $this->database = new Database();
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function rename($name)
    {
        $this->name = $name;
    }

    public function editSubject($subject)
    {
        $this->subject = $subject;
    }

    public function UpdateById($data, $id)
    {
        $this->database->mysql->query("UPDATE `students_db` SET `name` = '{$data["name"]}', `subject` = '{$data["subject"]}', WHERE `id` = {$id}"); 
    }

    public function Update()
    {
        $this->database->mysql->query("UPDATE `students_db` SET `name` =  '{$this->name}', `subject` = '{$this->subject}' WHERE `id` = {$this->id}");
    }
}

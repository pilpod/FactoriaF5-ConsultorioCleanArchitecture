<?php

namespace App\Domain\Services;

// use App\Core\View;
use App\Domain\Models\Coder;
use phpDocumentor\Reflection\Location; // QUE ES ESTO?

class CodersController
{

    public function __construct()
    {
        if (isset($_GET) && isset($_GET["action"]) && ($_GET["action"] == "create")) {
            $this->create();
            return;
        }

        if (isset($_GET) && isset($_GET["action"]) && ($_GET["action"] == "store")) {
            $this->store($_POST);
            return;
        }

        if (isset($_GET) && isset($_GET["action"]) && ($_GET["action"] == "edit")) {
            $this->edit($_GET["id"]);
            return;
        }
        
        if (isset($_GET) && isset($_GET["action"]) && ($_GET["action"] == "update")) {
            $this->update($_POST, $_GET["id"]);
            return;
        }

        if (isset($_GET) && isset($_GET["action"]) && ($_GET["action"] == "delete")) {

            $this->delete($_GET["id"]);
            return;
        }

        $this->index();
       
    }

    public function index(): void
    {
        $codersList = Coder::all();

        new View("CoderList", [
            "students_db" => $codersList,
        ]);
    }

    public function create(): void
    {
        new View("CreateCoder");
    }

    public function store(array $request): void
    {
        $newCoder = new Coder($request["name"], $request["subject"]);
        $newCoder->save();

        $this->index();
    }

    public function delete($id)
    {
        $coderToDelete = Coder::findById($id);
        $coderToDelete->delete();

        $this->index();
    }
    
    public function edit($id)
    {
        $coderToEdit = Coder::findById($id);
        new View("EditCoder", ["coder" => $coderToEdit]);
    }

    public function update(array $request, $id)
    {
        $coderToUpdate = Coder::findById($id);
        $coderToUpdate->rename($request["name"]);
        $coderToUpdate->editSubject($request["subject"]);
        $coderToUpdate->update();

        $this->index();
    }
}

<?php

namespace App\Controllers;

use App\Core\View;
use App\Domain\Models\Coder;
use App\Infrastructure\Files\Logger;
use App\Domain\Contracts\IWriteInFiles;
use App\Infrastructure\DB\MysqlRepo;
use App\Domain\Services\DeleteCoder;
use App\Domain\Services\SaveCoder;
use App\Domain\Services\ListAllCoders;
use App\Domain\Services\CoderToEdit;
use App\Domain\Services\UpdateDataCoder;
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
        $mysqlRepo = new MysqlRepo();
        $service = new ListAllCoders($mysqlRepo);
        $listOfCoders = $service->execute();

        new View("CoderList", [
            "students_db" => $listOfCoders,
        ]);
    }

    public function create(): void
    {
        new View("CreateCoder");
    }

    public function store(array $request): void
    {
        $mysqlRepo = new MysqlRepo();
        $service = new SaveCoder($mysqlRepo);

        $service->execute($request);

        $this->index();
    }

    public function delete($id)
    {
        $mysqlRepo = new MysqlRepo();
        $service = new DeleteCoder($mysqlRepo);
        $service->execute($id);

        $this->index();
    }
    
    public function edit($id)
    {
        $mysqlRepo = new MysqlRepo();
        $service = new CoderToEdit($mysqlRepo);

        $coderToEdit = $service->execute($id);
        new View("EditCoder", ["coder" => $coderToEdit]);
    }

    public function update(array $request, $id)
    {
        $mysqlRepo = new MysqlRepo();
        $service = new UpdateDataCoder($mysqlRepo);

        $service->execute($request, $id);

        $this->index();
    }
}

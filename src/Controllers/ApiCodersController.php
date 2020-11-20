<?php

namespace App\Controllers;

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

class ApiCodersController implements IWriteInFiles
{

    public function __construct(string $method, array $content = null, $id = null)
    {
        var_dump($id);

        if ($method == "GET") {
            $this->index();
        }

        if($method == "POST") {
            var_dump($content);
            $this->store($content);
        }

        if($method == "GET" && $id != null) {
            $this->edit($id);
        }

        if($method == "DELETE" && $id != null) {
            $this->delete($id);
        }

        if($method == "POST" && $id != null) {
            $this->update($content, $id);
        }

        /* if (isset($_GET) && isset($_GET["action"]) && ($_GET["action"] == "store")) {
            $data = $_POST;
            $this->store($_POST);
            return;
        } */

        /* if (isset($_GET) && isset($_GET["action"]) && ($_GET["action"] == "edit")) {
            $this->edit($_GET["id"]);
            return;
        } */
        
        /* if (isset($_GET) && isset($_GET["action"]) && ($_GET["action"] == "update")) {
            $this->update($_POST, $_GET["id"]);
            return;
        } */

        /* if (isset($_GET) && isset($_GET["action"]) && ($_GET["action"] == "delete")) {
            $this->delete($_GET["id"]);
            return;
        } */
       
    }

    public function index(): void
    {
        $mysqlRepo = new MysqlRepo();
        $service = new ListAllCoders($mysqlRepo);
        $listOfCoders = $service->execute();

        $coderList = [];

        foreach ($listOfCoders as $coder) {
            // print("<pre>".print_r($coder,true)."</pre>");
            $newCoderList = [
                "id" => $coder->getId(),
                "name" => $coder->getName(),
                "subject" => $coder->getSubject(),
                "created" => $coder->getCreatedAt(),
            ];

            array_push($coderList, $newCoderList);
         }

        echo json_encode($coderList);

        $this->WriteInLoggerFile('Página home visitada');

    }

    public function store(array $request): void
    {
        $mysqlRepo = new MysqlRepo();
        $service = new SaveCoder($mysqlRepo);

        $lastCoder = $service->execute($request);
        
        $lastCoder = [
            "id" => $lastCoder->getId(),
            "name" => $lastCoder->getName(),
            "subject" => $lastCoder->getSubject(),
            "createAt" => $lastCoder->getCreatedAt()
        ];
        
        echo json_encode($lastCoder);

        $this->WriteInLoggerFile('El coder con id: '.$lastCoder['id'].' ha sido guardado');

    }

    public function delete($id)
    {
        $mysqlRepo = new MysqlRepo();
        $service = new DeleteCoder($mysqlRepo);
        $coderDeleted = $service->execute($id);

        $dataCoderDeleted = [
            "id" => $coderDeleted->getId(),
            "name" => $coderDeleted->getName(),
            "subject" => $coderDeleted->getSubject(),
            "create_at" => $coderDeleted->getCreatedAt(),
        ];

        echo json_encode($dataCoderDeleted);

        $this->WriteInLoggerFile('El coder con id '.$dataCoderDeleted['id'].' ha sido borrado');

    }
    
    public function edit($id)
    {
        $mysqlRepo = new MysqlRepo();
        $service = new CoderToEdit($mysqlRepo);

        $coderToEdit = $service->execute($id);

        $coderData = [
            "id" => $coderToEdit->getId(),
            "name" => $coderToEdit->getName(),
            "subject" => $coderToEdit->getSubject(),
        ];

        echo json_encode($coderData);

        $this->WriteInLoggerFile('Intentando modificar el coder número '.$id.' de la base de datos.');
    }

    public function update(array $request, $id)
    {
        $mysqlRepo = new MysqlRepo();
        $service = new UpdateDataCoder($mysqlRepo);

        $coderToUpdate = $service->execute($request, $id);

        $coderUpdated = [
            "id" => $coderToUpdate->getID(),
            "name" => $coderToUpdate->getName(),
            "subject" => $coderToUpdate->getSubject(),
            "create_at" => $coderToUpdate->getCreatedAt(),
        ];

        echo json_encode($coderUpdated);

        $this->WriteInLoggerFile('El coder '.$id.' ha sido modificado');

    }

    public function WriteInLoggerFile($message)
    {
        $logger = new Logger();
        $logger->WriteFile($message);
    }
}

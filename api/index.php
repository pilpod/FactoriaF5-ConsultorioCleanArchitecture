<?php 

require("../vendor/autoload.php");
header("Content-Type: application/json");

$request = $_SERVER;

// echo $request["REQUEST_METHOD"];
// echo file_get_contents("php://input");
// echo $_GET["id"];

new App\Core\ApiRouter($request);
// new App\Controllers\ApiCodersController();
?>
<?php
require_once "../libs/connection.php";
session_start();
class Process
{
    private $responseObj;

    public function __construct()
    {
        $this->responseObj = new stdClass();
    }

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handlePOSTRequest();
        } else {
            $this->responseObj->error = "Invalid request Method.";
            $this->sendResponse(400);
        }
    }

    private function handlePOSTRequest()
    {
        if (isset($_POST["name"]) && isset($_POST["function"]) && isset($_POST["code"])) {
            if ($_POST["function"] == "add") {
                $this->addColor();
            } else if ($_POST["function"] == "update") {
                $this->updateColor();
            }
        } else {
            $this->responseObj->error = "Requested parameters are empty.";
            $this->sendResponse(400);
        }
    }

    private function addColor()
    {
        $name = $_POST["name"];
        $code = $_POST["code"];
        $this->insertColor($name, $code);
        $this->responseObj->done = "Color Added.";
        $this->sendResponse();
    }

    private function updateColor()
    {
        $name = $_POST["name"];
        $code = $_POST["code"];
        $id = $_POST["id"];

        $color = $this->geColorById($id);
        if ($color) {
            $this->updateColorDetails($name, $code, $id);
            $this->responseObj->done = "Color Updated.";
            $this->sendResponse();
        } else {
            $this->responseObj->error = "Invalid Color.";
            $this->sendResponse(400);
        }
    }

    private function insertColor($name, $code)
    {
        return $this->iud("INSERT INTO `color` (`color`,`code`) VALUES ('" . $name . "','" . $code . "')");
    }

    private function geColorById($id)
    {
        $result =  $this->search("SELECT * FROM `color` WHERE `id`='" . $id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function updateColorDetails($name, $code, $id)
    {
        $this->iud("UPDATE `color` SET `color`='" . $name . "' , `code`='" . $code . "'  WHERE `id`='" . $id . "'");
    }

    private function search($q)
    {
        return Database::search($q);
    }

    private function iud($q)
    {
        Database::iud($q);
    }

    private function sendResponse($statusCode = 200)
    {
        http_response_code($statusCode);
        echo json_encode($this->responseObj);
    }
}

$process = new Process();
$process->handleRequest();

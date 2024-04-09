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
        if (isset($_POST["name"]) && isset($_POST["function"]) && isset($_POST["type"])) {
            if ($_POST["function"] == "add") {
                $this->addBrandOrModel();
            } else if ($_POST["function"] == "update") {
                $this->updateBrandOrModel();
            }
        } else {
            $this->responseObj->error = "Requested parameters are empty.";
            $this->sendResponse(400);
        }
    }

    private function addBrandOrModel()
    {
        $name = $_POST["name"];
        if ($_POST["type"] == "brand") {
            $this->insertBrand($name);
            $this->responseObj->done = "Brand Added.";
        } else if ($_POST["type"] == "model") {
            $this->insertModel($name);
            $this->responseObj->done = "Model Added.";
        }
        $this->sendResponse();
    }

    private function updateBrandOrModel()
    {
        $name = $_POST["name"];
        $id = $_POST["id"];
        if ($_POST["type"] == "brand") {
            $brand = $this->getBrandById($id);
            if ($brand) {
                $this->updateBrandName($name, $id);
                $this->responseObj->done = "Brand Updated.";
                $this->sendResponse();
            } else {
                $this->responseObj->error = "Invalid Brand.";
                $this->sendResponse(400);
            }
        } else if ($_POST["type"] == "model") {
            $model = $this->getModelById($id);
            if ($model) {
                $this->updateModelName($name, $id);
                $this->responseObj->done = "Model Updated.";
                $this->sendResponse();
            } else {
                $this->responseObj->error = "Invalid Model.";
                $this->sendResponse(400);
            }
        }
    }

    private function insertBrand($name)
    {
        return $this->iud("INSERT INTO `brand` (`brand_name`) VALUES ('" . $name . "')");
    }

    private function insertModel($name)
    {
        return $this->iud("INSERT INTO `model` (`model_name`) VALUES ('" . $name . "')");
    }

    private function getBrandById($id)
    {
        $result =  $this->search("SELECT * FROM `brand` WHERE `id`='" . $id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getModelById($id)
    {
        $result =  $this->search("SELECT * FROM `model` WHERE `id`='" . $id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function updateBrandName($name, $id)
    {
        $this->iud("UPDATE `brand` SET `brand_name`='" . $name . "' WHERE `id`='" . $id . "'");
    }

    private function updateModelName($name, $id)
    {
        $this->iud("UPDATE `model` SET `model_name`='" . $name . "' WHERE `id`='" . $id . "'");
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

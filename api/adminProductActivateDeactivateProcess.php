<?php
require_once "../libs/connection.php";

class Process
{
    private $responseObj;

    public function __construct()
    {
        $this->responseObj = new stdClass();
    }

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->handleGETRequest();
        } else {
            $this->responseObj->error = "Invalid Request Method.";
            $this->sendResponse(400);
        }
    }

    private function handleGETRequest()
    {
        if (isset($_GET["status_id"]) && isset($_GET["product_id"])) {
            $product_id = $_GET["product_id"];
            $status_id = $_GET["status_id"];
            $product = $this->getProductById($product_id);
            if ($product) {
                $this->updateProductStatus($status_id, $product_id);
                if ($status_id == 1) {
                    $this->responseObj->msg = "Activated Product.";
                } else {
                    $this->responseObj->msg = "Deactivated Product.";
                }
                $this->sendResponse();
            } else {
                $this->responseObj->error = "Invalid User.";
                $this->sendResponse(400);
            }
        } else {
            $this->responseObj->error = "Requested parameters are empty.";
            $this->sendResponse(400);
        }
    }

    private function getProductById($id)
    {
        $result = $this->search("SELECT * FROM `product` WHERE `id`='" . $id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function updateProductStatus($id, $product_id)
    {
        $this->iud("UPDATE `product` SET `status_id`='" . $id . "' WHERE `id`='" . $product_id . "'");
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

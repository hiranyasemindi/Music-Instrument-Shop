<?php
require_once "../libs/connection.php";
session_start();

$process = new Process();
$process->handleRequest();

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
        if (isset($_GET["id"]) && isset($_GET["value"])) {
            if (isset($_SESSION["user"])) {
                $product_id = $_GET["id"];
                $product = $this->getProductById($product_id);
                if ($product) {
                    $this->updateProductRating($product_id, $_GET["value"]);
                    $this->responseObj->msg = "Success.";
                    $this->sendResponse();
                } else {
                    $this->responseObj->error = "product not available.";
                    $this->sendResponse(400);
                }
            } else {
                $this->responseObj->error = "Please login to continue.";
                $this->sendResponse(400);
            }
        } else {
            $this->responseObj->error = "Request parameters are empty.";
            $this->sendResponse(400);
        }
    }

    private function updateProductRating($pid, $rating)
    {
        $this->iud("UPDATE `product` SET `rating`='" . $rating . "' WHERE `id`='" . $pid . "'");
    }

    private function getProductById($product_id)
    {
        $result = $this->search("SELECT * FROM `product` WHERE `id`='" . $product_id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
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

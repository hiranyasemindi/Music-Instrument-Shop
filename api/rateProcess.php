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
                $email = $_SESSION["user"]["email"];
                $product_id = $_GET["id"];
                $value = $_GET["value"];
                $product = $this->getProductById($product_id);
                if ($product) {
                    $addedStatus = $this->getAddedRating($email, $product_id);
                    if ($addedStatus) {
                        $this->updateRating($email, $product_id, $value);
                    } else {
                        $this->addRating($email, $product_id, $value);
                    }
                    $this->calculateRating($product_id);
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

    private function calculateRating($product_id)
    {
        $allRatings = $this->getRatingForProduct($product_id);
        $rateSum = 0;
        $count = 0;
        foreach ($allRatings as $rating) {
            $rateSum = $rateSum + (int)$rating["rating"];
            $count++;
        }
        $avgRating = $rateSum / $count;
        $this->updateProductRating($product_id, $avgRating);
    }

    private function getRatingForProduct($product_id)
    {
        $result = $this->search("SELECT * FROM `ratings` WHERE `ratings`.`product_id`='" . $product_id . "'");
        return $result->num_rows > 0 ? $result : null;
    }

    private function addRating($email, $product, $rating)
    {
        $this->iud("INSERT INTO `ratings` (`user_email`,`product_id`,`rating`) VALUES ('" . $email . "','" . $product . "','" . $rating . "')");
    }

    private function updateRating($email, $product, $rating)
    {
        $this->iud("UPDATE `ratings` SET `rating`='" . $rating . "' WHERE `product_id`='" . $product . "' AND `user_email`='" . $email . "' ");
    }

    private function getAddedRating($email, $product)
    {
        $result = $this->search("SELECT * FROM `ratings` WHERE `product_id`='" . $product . "' AND `user_email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
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

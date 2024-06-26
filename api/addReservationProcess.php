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
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->handleGETRequest();
        } else {
            $this->responseObj->error = "Invalid request Method.";
            $this->sendResponse(400);
        }
    }

    private function handleGETRequest()
    {
        if ($_SESSION["user"]) {
            if (isset($_GET["pickup"]) && isset($_GET["product"])) {
                $this->addReservation();
            } else {
                $this->responseObj->error = "Requested parameters are empty.";
                $this->sendResponse(400);
            }
        } else {
            $this->responseObj->error = "Please login first.";
            $this->sendResponse(400);
        }
    }

    private function addReservation()
    {
        $pickup =  $_GET["pickup"];
        $product_id =  $_GET["product"];
        $user_email = $_SESSION["user"]["email"];
        $date = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $date->setTimezone($tz);
        $today = $date->format("Y-m-d H:i:s");
        $product =  $this->getProductById($product_id);
        $reservation_id = uniqid();
        if ($product) {
            $this->insertReservation($product_id, $pickup, $user_email, $today, $reservation_id);
            $this->responseObj->msg = "Reservation Added Successfully.";
            $this->sendResponse();
        } else {
            $this->responseObj->error = "Not a valid product";
            $this->sendResponse(400);
        }
    }

    private function getProductById($id)
    {
        $result =  $this->search("SELECT * FROM `product` WHERE `id`='" . $id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function insertReservation($product_id, $pickup, $user_email, $today, $reservation_id)
    {
        $this->iud("INSERT INTO `reservation` 
        (`reservation_id`,`reservation_date`,`pickup_date`,`product_id`,`user_email`,`reservation_status_status_id`)
        VALUES('" . $reservation_id . "','" . $today . "','" . $pickup . "','" . $product_id . "','" . $user_email . "','1')");
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

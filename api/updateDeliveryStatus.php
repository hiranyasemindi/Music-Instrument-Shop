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
        if (isset($_GET["order_id"])) {
            $order_id = $_GET["order_id"];
            $order = $this->getOrderById($order_id);
            if ($order) {
                $this->updateDelieverStatus($order_id);
                $this->responseObj->msg = "Updated Status.";
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

    private function getOrderById($id)
    {
        $result = $this->search("SELECT * FROM `invoice` WHERE `order_id`='" . $id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function updateDelieverStatus($order_id)
    {
        $this->iud("UPDATE `invoice` SET `deliver_status_id`='2' WHERE `order_id`='" . $order_id . "'");
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

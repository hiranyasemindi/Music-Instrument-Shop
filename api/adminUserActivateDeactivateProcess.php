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
        if (isset($_GET["id"]) && isset($_GET["email"])) {
            $status_id = $_GET["id"];
            $email = $_GET["email"];
            $user = $this->getUserByEmail($email);
            if ($user) {
                $this->updateUserStatus($status_id, $email);
                if ($status_id == 1) {
                    $this->responseObj->msg = "Activated User.";
                } else {
                    $this->responseObj->msg = "Deactivated User.";
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

    private function getUserByEmail($email)
    {
        $result = $this->search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function updateUserStatus($id, $email)
    {
        $this->iud("UPDATE `user` SET `status_id`='" . $id . "' WHERE `email`='" . $email . "'");
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

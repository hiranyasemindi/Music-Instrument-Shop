<?php
session_start();

$process = new Process();
$process->handleRequest();

class Process
{
    private $responseObject;
    public function __construct()
    {
        $this->responseObject = new stdClass();
    }

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->handleGETRequest();
        } else {
            $this->responseObject->error = "Invalid Request Method.";
            $this->sendResponse(400);
        }
    }

    private function handleGETRequest()
    {
        if ($_GET["type"]) {
            $type = $_GET["type"];
            if ($type == "admin") {
                $_SESSION["admin"] = null;
                session_destroy();
                $this->responseObject->msg = "Logout Sucess.";
                $this->sendResponse();
            } else if ($type == "user") {
                $_SESSION["user"] = null;
                session_destroy();
                $this->responseObject->msg = "Logout Sucess.";
                $this->sendResponse();
            }
        } else {
            $this->responseObject->error = "Request Parameters are Empty.";
            $this->sendResponse(400);
        }
    }

    private function sendResponse($statusCode = 200)
    {
        http_response_code($statusCode);
        echo json_encode($this->responseObject);
    }
}

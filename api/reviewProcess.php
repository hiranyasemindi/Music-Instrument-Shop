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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handlePOSTRequest();
        } else {
            $this->responseObj->error = "Invalid Request Method.";
            $this->sendResponse(400);
        }
    }

    private function handlePOSTRequest()
    {
        if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            if (json_last_error() == JSON_ERROR_NONE) {
                if (isset($_SESSION["user"])) {
                    $email = $_SESSION["user"]["email"];
                    $review = $decoded["review"];
                    $user =  $this->getUserByEmail($email);
                    if ($user) {
                        $this->insertReview($review, $email);
                        $this->responseObj->msg = "Success.";
                        $this->sendResponse();
                    } else {
                        $this->responseObj->error = "User not found.";
                        $this->sendResponse(400);
                    }
                } else {
                    $this->responseObj->error = "Please login to continue.";
                    $this->sendResponse(400);
                }
            } else {
                $this->responseObj->error = "Invalid JSON.";
                $this->sendResponse(400);
            }
        } else {
            $this->responseObj->error = "Invalid Content-Type.";
            $this->sendResponse(400);
        }
    }

    private function insertReview($review, $email)
    {
        $this->iud("INSERT INTO `reviews` (`review`,`user_email`) VALUES('" . $review . "','" . $email . "')");
    }

    private function getUserByEmail($email)
    {
        $result =  $this->search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
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

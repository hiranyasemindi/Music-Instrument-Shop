<?php

require_once "../libs/connection.php";

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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                $this->signUp($decoded);
            } else {
                $this->responseObj->error = "Invalid JSON.";
                $this->sendResponse(400);
            }
        } else {
            $this->responseObj->error = "Invalid Content-Type.";
            $this->sendResponse(400);
        }
    }

    private function signUp($decoded)
    {
        $fname = $decoded['fname'];
        $lname = $decoded['lname'];
        $email = $decoded['email'];
        $password = $decoded['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $mobile = $decoded['mobile'];
        $gender = $decoded['gender'];
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");
        $user = $this->getUserByEmail($email);
        if ($user) {
            $this->responseObj->error = "This is already a registered email address.";
            $this->sendResponse(400);
        } else {
            $this->insertUser($fname, $lname, $email, $hashed_password, $gender, $date, $mobile);
            $this->responseObj->msg = "Successfully Regitered.";
            $this->sendResponse();
        }
    }

    private function getUserByEmail($email)
    {
        $result =  $this->search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function sendResponse($statusCode = 200)
    {
        http_response_code($statusCode);
        echo json_encode($this->responseObj);
    }

    private function insertUser($fname, $lname, $email, $hashed_password, $gender, $date, $mobile)
    {
        $this->iud("INSERT INTO `user` (`fname`,`lname`,`email`,`password`,`gender_id`,`status_id`,`joined_date`,`mobile`)
        VALUES('" . $fname . "','" . $lname . "','" . $email . "','" . $hashed_password . "','" . $gender . "','1','" . $date . "','" . $mobile . "')");
    }

    private function search($q)
    {
        return Database::search($q);
    }

    private function iud($q)
    {
        Database::iud($q);
    }
}

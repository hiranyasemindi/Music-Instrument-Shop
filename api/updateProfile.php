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
            $this->sendResponse(400);
            $this->responseObj->error = "Invalid request Method.";
        }
    }

    private function handlePOSTRequest()
    {
        if ($_SERVER["CONTENT_TYPE"] == "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content);
            if (json_last_error() == JSON_ERROR_NONE) {
                $this->updateProfile($decoded);
            } else {
                $this->sendResponse(400);
                $this->responseObj->error = "Invalid JSON.";
            }
        } else {
            $this->sendResponse(400);
            $this->responseObj->error = "Invalid Content Type.";
        }
    }

    private function updateProfile($decoded)
    {
        $email = $_SESSION["user"]["email"];
        $fname = $decoded->fname;
        $lname = $decoded->lname;
        $line1 = $decoded->line1;
        $line2 = $decoded->line2;
        $line2 = $decoded->line2;
        $city = $decoded->city;
        $postalCode = $decoded->postalCode;
        $user = $this->getUserByEmail($email);
        if ($user) {
            $this->updateUserDetails($fname, $lname, $email);
            $address = $this->getuserAdressDetails($email);
            if ($address) {
                $this->updateUserAddressDetails($line1, $line2, $postalCode, $city, $email);
                $this->responseObj->msg = "Update Success.";
                $this->sendResponse();
            } else {
                $this->insertUserAddressDetails($line1, $line2, $postalCode, $city, $email);
                $this->responseObj->msg = "Insert Success.";
                $this->sendResponse();
            }
        } else {
            $this->sendResponse(400);
            $this->responseObj->error = "Invalid User.";
        }
    }

    private function updateUserAddressDetails($line1, $line2, $postalCode, $city, $email)
    {
        $this->iud("UPDATE `user_has_address` SET `line1`='" . $line1 . "', `line2`='" . $line2 . "', `postal_code`='" . $postalCode . "', `city_id`='" . $city . "' 
        WHERE `user_email`='" . $email . "'; ");
    }

    private function insertUserAddressDetails($line1, $line2, $postalCode, $city, $email)
    {
        $this->iud("INSERT INTO `user_has_address` (`line1`,`line2`,`postal_code`,`city_id`,`user_email`) 
        VALUES('" . $line1 . "', '" . $line2 . "', '" . $postalCode . "', '" . $city . "', '" . $email . "')");
    }

    private function getuserAdressDetails($email)
    {
        $result = $this->search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function updateUserDetails($fname, $lname, $email)
    {
        $this->iud("UPDATE `user` SET `fname`='" . $fname . "', `lname` = '" . $lname . "' WHERE `email`='" . $email . "'");
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

$process = new Process();
$process->handleRequest();

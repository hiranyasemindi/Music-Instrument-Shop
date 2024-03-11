<?php
require_once "../libs/connection.php";


class Process
{
    private $responseObj;

    private function __construct()
    {
        $this->responseObj = new stdClass();
    }

    private function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'GET') {
            $this->handleGETRequest();
        } else if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $this->handlePOSTRequest();
        } else {
            $this->responseObj->error = "Invalid Request Method.";
            $this->sendReponse(400);
        }
    }

    private function sendReponse($statusCode = 200)
    {
        http_response_code($statusCode);
        echo json_encode($this->responseObj);
    }

    private function handleGETRequest()
    {
        if (isset($_GET["email"])) {
            $this->sendVcode();
        } else {
            $this->responseObj->error = "Required Parameters are Incomplete.";
            $this->sendReponse(400);
        }
    }

    private function handlePOSTRequest()
    {
        if ($_SERVER["CONTENT_TYPE"] == "application/json") {
            $content = trim((file_get_contents("php://input")));
            $decoded = json_decode($content);
            if (json_last_error() == JSON_ERROR_NONE) {
                $this->resetPassword($decoded);
            } else {
                $this->responseObj->error = "Invalid JSON.";
                $this->sendReponse(400);
            }
        } else {
            $this->responseObj->error = "Invalid Content-Type.";
            $this->sendReponse(400);
        }
    }

    private function sendVcode()
    {
        $email = $_GET['email'];
        $user = $this->searchUserByEmail($email);
        if ($user) {
            $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $this->updateVerificationCode($otp, $email);
            $body = "<h1>Sonority Forgot Password Verification Code</h1>
            <h4>" . $otp . "</h4>";
            $result = Email::sendEmail($email, $body);
            if ($result) {
                $this->responseObj->msg = "openModel";
            } else {
                $this->responseObj->error = "Verification Code Sending Failed.";
                $this->sendReponse(400);
            }
        } else {
            $this->responseObj->error = "This email is not a registered email address.";
            $this->sendReponse(400);
        }
    }

    private function iud($q)
    {
        Database::iud($q);
    }

    private function search($q)
    {
        return Database::search($q);
    }

    private function resetPassword($decoded)
    {
        $npw = $decoded["npw"];
        $vcode = $decoded['vcode'];
        $email = $decoded['email'];
        $user = $this->getUserByEmailAndVerificationCode($vcode, $email);
        if ($user) {
            $hashed_password = password_hash($npw, PASSWORD_DEFAULT);
            $this->updatePassword($hashed_password, $email);
            $this->responseObj->msg = "Reset Success";
        } else {
            $this->responseObj->error = "Verification Code is Invalid";
        }
    }

    private function searchUserByEmail($e)
    {
        $result = $this->search("SELECT * FROM `user` WHERE `email`='" . $e . "'");
        return $result->num_rows > 0 ?  $result->fetch_assoc() : null;
    }

    private function updateVerificationCode($otp, $email)
    {
        $this->iud("UPDATE `user` SET `verification_code`='" . $otp . "' WHERE `email` = '" . $email . "'");
    }

    private function getUserByEmailAndVerificationCode($email, $vcode)
    {
        $result =  $this->search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `verification_code`='" . $vcode . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function updatePassword($hashed_password, $email)
    {
        $this->iud("UPDATE `user` SET `password`='" . $hashed_password . "' WHERE `email`='" . $email . "' ");
    }
}

<?php
require_once "../libs/connection.php";
require "../libs/PHPMailer.php";
require "../libs/sendEmail.php";

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
        $user = $this->searchAdminByEmail($email);
        if ($user) {
            $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $this->updateVerificationCode($otp, $email);
            $body = "<h1>Sonority Admin Forgot Password Verification Code</h1>
            <h4>" . $otp . "</h4>";
            $result = $this->sendEmail($email, $body);
            if ($result == "Success") {
                $this->responseObj->msg = "openModel";
                $this->sendReponse();
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

    private function sendEmail($email, $body)
    {
        return Email::sendEmail($email, $body);
    }

    private function resetPassword($decoded)
    {
        $npw = $decoded->npw;
        $vcode = $decoded->vcode;
        $email = $decoded->email;
        $user = $this->getUserByEmailAndVerificationCode($email, $vcode);
        if ($user) {
            $hashed_password = password_hash($npw, PASSWORD_DEFAULT);
            $this->updatePassword($hashed_password, $email);
            $this->responseObj->msg = "Reset Success";
            $this->sendReponse();
        } else {
            $this->responseObj->error = "Verification Code is Invalid";
            $this->sendReponse(400);
        }
    }

    private function searchAdminByEmail($e)
    {
        $result = $this->search("SELECT * FROM `admin` WHERE `email`='" . $e . "'");
        return $result->num_rows > 0 ?  $result->fetch_assoc() : null;
    }

    private function updateVerificationCode($otp, $email)
    {
        $this->iud("UPDATE `admin` SET `vcode`='" . $otp . "' WHERE `email` = '" . $email . "'");
    }

    private function getUserByEmailAndVerificationCode($email, $vcode)
    {
        $result =  $this->search("SELECT * FROM `admin` WHERE `email`='" . $email . "' AND `vcode`='" . $vcode . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function updatePassword($hashed_password, $email)
    {
        $this->iud("UPDATE `admin` SET `password`='" . $hashed_password . "' WHERE `email`='" . $email . "' ");
    }
}

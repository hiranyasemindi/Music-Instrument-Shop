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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handlePOSTRequest();
        } else {
            $this->responseObj->error = "Invaid Request Method.";
            $this->sendResponse(400);
        }
    }

    private function handlePOSTRequest()
    {
        if ($_SERVER["CONTENT_TYPE"] == "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content);
            if (json_last_error() == JSON_ERROR_NONE) {
                $this->login($decoded);
            } else {
                $this->responseObj->error = "Invaid JSON.";
                $this->sendResponse(400);
            }
        } else {
            $this->responseObj->error = "Invaid Content Type.";
            $this->sendResponse(400);
        }
    }

    private function login($decoded)
    {
        $email = $decoded->email;
        $password = $decoded->password;
        $rememberMe = $decoded->rememberMe;
        $user = $this->getAdminByEmail($email);
        if ($user) {
            if (password_verify($password, $user["password"])) {
                session_start();
                $_SESSION['admin'] = $user;
                if ($rememberMe == "true") {
                    setcookie("email", $email, time() + (60 * 60 * 24 * 365));
                    setcookie("password", $password, time() + (60 * 60 * 24 * 365));
                } else {
                    setcookie("email", "", -1);
                    setcookie("password", "", -1);
                }
                $this->responseObj->msg = "SignIn Success.";
                $this->sendResponse();
            } else {
                $this->responseObj->error = "Password is Incorrect";
                $this->sendResponse(400);
            }
        } else {
            $this->responseObj->error = "Incorrect Email or Password.";
            $this->sendResponse(400);
        }
    }

    private function getAdminByEmail($email)
    {
        $result =  $this->search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function search($q)
    {
        return Database::search($q);
    }

    private function sendResponse($statusCode = 200)
    {
        http_response_code($statusCode);
        echo json_encode($this->responseObj);
    }
}

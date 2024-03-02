<?php
$responseObj = new stdClass();
$process = new Process();
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (isset($_GET["function"]) && isset($_GET["email"])) {
        require_once "../libs/connection.php";
        require "../libs/SMTP.php";
        require "../libs/PHPMailer.php";
        require "../libs/Exception.php";
        require "../libs/sendEmail.php";
        if ($_GET["function"] == "openModel") {
            $process->sendVcode();
        }
    } else {
        http_response_code(400);
        $responseObj->error = "Required Parameters are Incomplete.";
    }
} else if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
        $content = trim(file_get_contents('php://input'));
        $decoded = json_decode($content, true);
        if (json_last_error() == JSON_ERROR_NONE) {
            require_once "../libs/connection.php";
            $npw = $decoded["npw"];
            $vcode = $decoded['vcode'];
            $function = $decoded['function'];
            $email = $decoded['email'];
            $process->resetPassword();
        } else {
            http_response_code(400);
            $responseObj->error = "Invalid JSON.";
        }
    } else {
        http_response_code(400);
        $responseObj->error = "Invalid Content-Type.";
    }
} else {
    http_response_code(400);
    $responseObj->error = "Invalid Request Method.";
}
echo json_encode($responseObj);

class Process
{
    function sendVcode()
    {
        $email = $_GET["email"];
        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
        if ($user_rs->num_rows > 0) {
            $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            Database::iud("UPDATE `user` SET `verification_code`='" . $otp . "' WHERE `email` = '" . $email . "'");
            $body = "<h1>Sonority Forgot Password Verification Code</h1>
            <h4>" . $otp . "</h4>";
            $result = Email::sendEmail($email, $body);
            if ($result == "Success") {
                $GLOBALS["responseObj"]->msg = "openModel";
            } else {
                $GLOBALS["responseObj"]->error = "Verification code sending failed";
            }
        } else {
            http_response_code(400);
            $GLOBALS["responseObj"]->error = "This email is not a registered email address.";
        }
    }

    function resetPassword()
    {
        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $GLOBALS["email"] . "' AND `verification_code`='" . $GLOBALS["vcode"] . "'");
        if ($user_rs->num_rows > 0) {
            $user_data = $user_rs->fetch_assoc();
            if ($user_data['verification_code'] == $GLOBALS['vcode']) {
                $hashed_password = password_hash($GLOBALS['npw'], PASSWORD_DEFAULT);
                Database::iud("UPDATE `user` SET `password` ='" .  $hashed_password . "' WHERE `email`='" . $GLOBALS["email"] . "' AND `verification_code`='" . $GLOBALS["vcode"] . "'");
                $GLOBALS["responseObj"]->msg = "Resetted Success.";
            } else {
                $GLOBALS["responseObj"]->error = "Your Verification Code is Invalid.";
            }
        } else {
            http_response_code(400);
            $GLOBALS["responseObj"]->error = "This email is not a registered email address.";
        }
    }
}

<?php
$responseObj = new stdClass();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
        $content = trim(file_get_contents('php://input'));
        $decoded = json_decode($content, true);
        if (json_last_error() == JSON_ERROR_NONE) {
            require_once "../libs/connection.php";

            $email = $decoded["email"];
            $password = $decoded['password'];
            $rememberMe = $decoded['rememberMe'];
            $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");

            if ($user->num_rows > 0) {
                $user_data = $user->fetch_assoc();
                if (password_verify($password, $user_data['password'])) {
                    session_start();
                    $_SESSION['user'] = $user_data;
                    if ($rememberMe == true) {
                        setcookie("email", $email, time() + (60 * 60 * 24 * 365));
                        setcookie("password", $password, time() + (60 * 60 * 24 * 365));
                    } else {
                        setcookie("email", "", -1);
                        setcookie("password", "", -1);
                    }
                    $responseObj->done = "SignIn Success.";
                } else {
                    $responseObj->error = "Incorrect Email or Password.";
                }
            } else {
                $responseObj->error = "Incorrect Email or Password.";
            }
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

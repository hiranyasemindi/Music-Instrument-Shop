<?php
$responseObj = new stdClass();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
        $content = trim(file_get_contents('php://input'));
        $decoded = json_decode($content, true);
        if (json_last_error() == JSON_ERROR_NONE) {

            require_once "../libs/connection.php";

            $fname = $decoded["fname"];
            $lname = $decoded["lname"];
            $email = $decoded["email"];
            $password = $decoded["password"];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $mobile = $decoded["mobile"];
            $gender = $decoded["gender"];
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
            if ($rs->num_rows > 0) {
                $responseObj->error = "This is already a registered email address.";
            } else {
                Database::iud("INSERT INTO `user` (`fname`,`lname`,`email`,`password`,`gender_id`,`status_id`,`joined_date`,`mobile`)
                VALUES('" . $fname . "','" . $lname . "','" . $email . "','" . $hashed_password . "','" . $gender . "','1','" . $date . "','" . $mobile . "')");
                $responseObj->done = "Successfully Regitered.";
            }
        } else {
            http_response_code(400);
            $responseObj->error = "Invalid JSON";
        }
    } else {
        http_response_code(400);
        $responseObj->error = "Invalid Content-Type";
    }
} else {
    http_response_code(400);
    $responseObj->error = "Invalid Request Method";
}
echo json_encode($responseObj);
?>
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
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $this->updateProfileImage();
        } else {
            $this->sendResponse(400);
            $this->responseObj->error = "No file Uploaded or file Upload Error.";
        }
    }

    private function updateProfileImage()
    {
        $email = $_SESSION["user"]["email"];
        $image = $_FILES["img"];
        $user = $this->getUserByEmail($email);
        if ($user) {
            unlink("../" . $user["profile_img"]);
            $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
            $file_extension = $image["type"];
            if (in_array($file_extension, $allowed_image_extentions)) {
                $new_file_extention = $this->getImageExtension($file_extension);
                $file_name = $this->getFileName($new_file_extention);
                if (move_uploaded_file($image["tmp_name"], "../" . $file_name)) {
                    $this->updateImage($file_name, $email);
                    $this->responseObj->msg = "Successfully Updated";
                    $this->sendResponse();
                } else {
                    $this->sendResponse(400);
                    $this->responseObj->error = "Failed to move the uploaded file.";
                }
            } else {
                $this->sendResponse(400);
                $this->responseObj->error = "You only allowed jpg/jpeg/png/svg.";
            }
        } else {
            $this->sendResponse(400);
            $this->responseObj->error = "Invalid User.";
        }
    }

    private function getFileName($new_file_extention)
    {
        return "assets/img/profile_images/" . $_SESSION["user"]["fname"] . "_" . uniqid() . $new_file_extention;
    }

    private function getImageExtension($file_extension)
    {
        if ($file_extension == "image/jpg") {
            return ".jpg";
        } else if ($file_extension == "image/jpeg") {
            return ".jpeg";
        } else if ($file_extension == "image/png") {
            return ".png";
        } else if ($file_extension == "image/svg+xml") {
            return ".svg";
        } else {
            return "";
        }
    }

    private function updateImage($file_name, $email)
    {
        return $this->iud("UPDATE `user` SET `profile_img`='" . $file_name . "'  WHERE `email`='" . $email . "'");
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

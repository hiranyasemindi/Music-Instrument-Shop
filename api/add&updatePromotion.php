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
            $this->responseObj->error = "Invalid request Method.";
            $this->sendResponse(400);
        }
    }

    private function handlePOSTRequest()
    {
        if (isset($_POST["description"]) && isset($_POST["function"])) {
            // if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                if ($_POST["function"] == "add") {
                    $this->addPromotion();
                } else if ($_POST["function"] == "update") {
                    $this->updatePromotion();
                }
            // } else {
            //     $this->responseObj->error = "No file Uploaded or file Upload Error.";
            //     $this->sendResponse(400);
            // }
        } else {
            $this->responseObj->error = "Requested parameters are empty.";
            $this->sendResponse(400);
        }
    }

    private function addPromotion()
    {
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $description = $_POST["description"];
            $date = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $date->setTimezone($tz);
            $today = $date->format("Y-m-d H:i:s");
            $this->insertPromotion($description, $today);
            $id = Database::$connection->insert_id;
            $this->updatePromotionImage($id);
            $this->responseObj->done = "Promotion Added.";
            $this->sendResponse();
        } else {
            $this->responseObj->error = "No file Uploaded or file Upload Error.";
            $this->sendResponse(400);
        }
    }

    private function updatePromotion()
    {
        if (isset($_FILES['img'])) {
            if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $description = $_POST["description"];
                $id = $_POST["id"];
                $promotion = $this->getPromotionById($id);
                if ($promotion) {
                    $this->updateDescription($description, $id);
                    $this->updatePromotionImage($id);
                    $this->responseObj->done = "Promotion Updated.";
                    $this->sendResponse();
                } else {
                    $this->responseObj->error = "Invalid Promotion.";
                    $this->sendResponse(400);
                }
            } else {
                $this->responseObj->error = "Requested parameters are empty.";
                $this->sendResponse(400);
            }
        } else {
            $description = $_POST["description"];
            $id = $_POST["id"];
            $promotion = $this->getPromotionById($id);
            if ($promotion) {
                $this->updateDescription($description, $id);
                $this->responseObj->done = "Promotion Updated.";
                $this->sendResponse();
            } else {
                $this->responseObj->error = "Invalid Promotion.";
                $this->sendResponse(400);
            }
        }
    }

    private function updatePromotionImage($id)
    {
        $image = $_FILES["img"];
        $promotion = $this->getPromotionById($id);
        if ($promotion) {
            $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
            $file_extension = $image["type"];
            if (in_array($file_extension, $allowed_image_extentions)) {
                $new_file_extention = $this->getImageExtension($file_extension);
                $file_name = $this->getFileName($new_file_extention, $id);
                if (move_uploaded_file($image["tmp_name"], "../" . $file_name)) {
                    $this->updateImage($file_name, $id);
                } else {
                    $this->responseObj->error = "Failed to move the uploaded file.";
                    $this->sendResponse(400);
                }
            } else {
                $this->responseObj->error = "You only allowed jpg/jpeg/png/svg.";
                $this->sendResponse(400);
            }
        } else {
            $this->responseObj->error = "Invalid Promotion.";
            $this->sendResponse(400);
        }
    }

    private function getFileName($new_file_extention, $id)
    {
        return "assets/img/promo_images/" . $id . "_" . uniqid() . $new_file_extention;
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

    private function updateImage($file_name, $id)
    {
        return $this->iud("UPDATE `promotions` SET `image`='" . $file_name . "'  WHERE `id`='" . $id . "'");
    }

    private function updateDescription($desc, $id)
    {
        return $this->iud("UPDATE `promotions` SET `description`='" . $desc . "'  WHERE `id`='" . $id . "'");
    }

    private function insertPromotion($desc, $date)
    {
        return $this->iud("INSERT INTO `promotions` (`description`,`date`) VALUES ('" . $desc . "','" . $date . "')");
    }

    private function getPromotionById($id)
    {
        $result =  $this->search("SELECT * FROM `promotions` WHERE `id`='" . $id . "'");
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

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
        if (isset($_POST["name"]) && isset($_POST["function"])) {
            if ($_POST["function"] == "add") {
                $this->addCategory();
            } else if ($_POST["function"] == "update") {
                $this->updateCategory();
            }
        } else {
            $this->responseObj->error = "Requested parameters are empty.";
            $this->sendResponse(400);
        }
    }

    private function addCategory()
    {
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $name = $_POST["name"];
            $this->insertCategory($name);
            $id = Database::$connection->insert_id;
            $this->updateCategoryImage($id);
            $this->responseObj->done = "Category Added.";
            $this->sendResponse();
        } else {
            $this->responseObj->error = "No file Uploaded or file Upload Error.";
            $this->sendResponse(400);
        }
    }

    private function updateCategory()
    {
        if (isset($_FILES['img'])) {
            if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $name = $_POST["name"];
                $id = $_POST["id"];
                $category = $this->getCategoryById($id);
                if ($category) {
                    $this->updateName($name, $id);
                    $this->updateCategoryImage($id);
                    $this->responseObj->done = "Category Updated.";
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
            $name = $_POST["name"];
            $id = $_POST["id"];
            $category = $this->getCategoryById($id);
            if ($category) {
                $this->updateName($name, $id);
                $this->responseObj->done = "Category Updated.";
                $this->sendResponse();
            } else {
                $this->responseObj->error = "Invalid Promotion.";
                $this->sendResponse(400);
            }
        }
    }

    private function updateCategoryImage($id)
    {
        $image = $_FILES["img"];
        $category = $this->getCategoryById($id);
        if ($category) {
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
        return "assets/img/category_images/" . $id . "_" . uniqid() . $new_file_extention;
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
        return $this->iud("UPDATE `category` SET `img_path`='" . $file_name . "'  WHERE `id`='" . $id . "'");
    }

    private function updateName($name, $id)
    {
        return $this->iud("UPDATE `category` SET `name`='" . $name . "'  WHERE `id`='" . $id . "'");
    }

    private function insertCategory($name)
    {
        return $this->iud("INSERT INTO `category` (`name`) VALUES ('" . $name . "')");
    }

    private function getCategoryById($id)
    {
        $result =  $this->search("SELECT * FROM `category` WHERE `id`='" . $id . "'");
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

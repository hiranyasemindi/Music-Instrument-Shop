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
        if (isset($_POST["description"]) && isset($_POST["function"]) && isset($_POST["title"]) && isset($_POST["qty"]) && isset($_POST["dfeecolombo"]) && isset($_POST["dfeeout"])) {
            if ($_POST["function"] == "add") {
                $this->addProdut();
            } else if ($_POST["function"] == "update") {
                $this->updateProduct();
            }
        } else {
            $this->responseObj->error = "Requested parameters are empty.";
            $this->sendResponse(400);
        }
    }

    private function addProdut()
    {
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $cat_id = $_POST["cat"];
            $brand_id = $_POST["br"];
            $model_id = $_POST["md"];
            $price = $_POST["pr"];
            $title = $_POST["title"];
            $description = $_POST["description"];
            $qty = $_POST["qty"];
            $dfeecolombo = $_POST["dfeecolombo"];
            $dfeeout = $_POST["dfeeout"];
            $date = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $date->setTimezone($tz);
            $today = $date->format("Y-m-d H:i:s");
            $brand_has_model = $this->getBrandHasModelId($brand_id, $model_id);
            $brand_has_model_id = "";
            if ($brand_has_model) {
                $brand_has_model_id = $brand_has_model["id"];
            } else {
                $this->addBrandHasModel($brand_id, $model_id);
                $brand_has_model_id = Database::$connection->insert_id;
            }
            $this->insertProduct($cat_id, $brand_has_model_id, $title, $qty, $dfeeout, $dfeecolombo, $description, $price, $today);
            $id = Database::$connection->insert_id;
            $this->updateProductImage($id);
            $this->responseObj->done = "Product Added.";
            $this->sendResponse();
        } else {
            $this->responseObj->error = "No file Uploaded or file Upload Error.";
            $this->sendResponse(400);
        }
    }

    private function updateProduct()
    {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $qty = $_POST["qty"];
        $dfeecolombo = $_POST["dfeecolombo"];
        $dfeeout = $_POST["dfeeout"];
        $id = $_POST["id"];
        if (isset($_FILES['img'])) {
            if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $product = $this->getProductById($id);
                if ($product) {
                    $this->updateProductDetails($title, $description, $qty, $dfeecolombo, $dfeeout, $id);
                    $this->updateProductImage($id);
                    $this->responseObj->done = "Product Updated.";
                    $this->sendResponse();
                } else {
                    $this->responseObj->error = "Invalid Product.";
                    $this->sendResponse(400);
                }
            } else {
                $this->responseObj->error = "Requested parameters are empty.";
                $this->sendResponse(400);
            }
        } else {
            $product = $this->getProductById($id);
            if ($product) {
                $this->updateProductDetails($title, $description, $qty, $dfeecolombo, $dfeeout, $id);
                $this->responseObj->done = "Product Updated.";
                $this->sendResponse();
            } else {
                $this->responseObj->error = "Invalid Product.";
                $this->sendResponse(400);
            }
        }
    }

    private function updateProductImage($id)
    {
        $image = $_FILES["img"];
        $product = $this->getProductById($id);
        if ($product) {
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
            $this->responseObj->error = "Invalid Product.";
            $this->sendResponse(400);
        }
    }

    private function getFileName($new_file_extention, $id)
    {
        return "assets/img/product_images/" . $id . "_" . uniqid() . $new_file_extention;
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
        return $this->iud("UPDATE `product` SET `image_path`='" . $file_name . "'  WHERE `id`='" . $id . "'");
    }

    private function updateProductDetails($title, $description, $qty, $dfeecolombo, $dfeeout, $id)
    {
        return $this->iud("UPDATE `product` SET `title`='" . $title . "', `description`='" . $description . "',`qty`='" . $qty . "', 
        `delivery_fee_colombo`='" . $dfeecolombo . "' , `delivery_fee_other`='" . $dfeeout . "' WHERE `id`='" . $id . "'");
    }

    private function getBrandHasModelId($brand_id, $model_id)
    {
        $result = $this->search("SELECT * FROM `brand_has_model` WHERE `brand_id`='" . $brand_id . "' AND `model_id`='" . $model_id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function addBrandHasModel($brand_id, $model_id)
    {
        $this->iud("INSERT INTO `brand_has_model` (`brand_id`, `model_id`) VALUES ('" . $brand_id . "','" . $model_id . "');
        ");
    }

    private function insertProduct($cat_id, $brand_has_model_id, $title, $qty, $dfeeout, $dfeecolombo, $description, $price, $today)
    {
        $this->iud("INSERT INTO `product` (`title`, `description`, `category_id`, `price`, `delivery_fee_colombo`, `delivery_fee_other`, `qty`,`status_id`, `added_date`, `condition_id`, `rating`, `brand_has_model_id`) 
        VALUES ('" . $title . "', '" . $description . "', '" . $cat_id . "', '" . $price . "', '" . $dfeecolombo . "', '" . $dfeeout . "', '" . $qty . "', 1, '" . $today . "', '1', '0', '" . $brand_has_model_id . "');
        ");
    }

    private function getProductById($id)
    {
        $result =  $this->search("SELECT * FROM `product` WHERE `id`='" . $id . "'");
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

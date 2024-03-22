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
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->handleGETRequest();
        } else {
            $this->responseObj->error = "Invalid Request Method.";
            $this->sendResponse(400);
        }
    }

    private function handleGETRequest()
    {
        if (isset($_GET["id"]) && isset($_GET["function"])) {
            $product_id = $_GET["id"];
            $result = $this->getProductById($product_id);
            if ($result) {
                $email = $_SESSION["user"]["email"];
                if ($_GET["function"] == "wishlist") {
                    $product = $this->getProductFromWishlist($product_id);
                    if ($product) {
                        $this->deleteFromWishlist($email, $product_id);
                        $this->responseObj->msg = "Product successfully removed from wishlist.";
                        $this->sendResponse();
                    } else {
                        $this->responseObj->error = "This product not available in the wishlist.";
                        $this->sendResponse(400);
                    }
                } else if ($_GET["function"] == "cart") {
                    $product = $this->getProductFromCart($product_id);
                    if ($product) {
                        $this->deleteFromCart($email, $product_id);
                        $this->responseObj->msg = "Product successfully removed from cart.";
                        $this->sendResponse();
                    } else {
                        $this->responseObj->error = "This product not available in the cart.";
                        $this->sendResponse(400);
                    }
                } else {
                    $this->responseObj->error = "Something went wrong.";
                    $this->sendResponse(400);
                }
            } else {
                $this->responseObj->error = "Product is not available.";
                $this->sendResponse(400);
            }
        } else {
            $this->responseObj->error = "Requested parameters are empty.";
            $this->sendResponse(400);
        }
    }

    private function getProductById($product_id)
    {
        $result = $this->search("SELECT * FROM `product` WHERE `id`='" . $product_id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function deleteFromWishlist($email, $product_id)
    {
        $this->iud("DELETE FROM `wishlist` WHERE `user_email`='" . $email . "' AND `product_id`='" . $product_id . "'");
    }

    private function getProductFromCart($product_id)
    {
        $result =  $this->search("SELECT * FROM `cart` WHERE `product_id`='" . $product_id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getProductFromWishlist($product_id)
    {
        $result =  $this->search("SELECT * FROM `wishlist` WHERE `product_id`='" . $product_id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function deleteFromCart($email, $product_id)
    {
        $this->iud("DELETE FROM `cart` WHERE `user_email`='" . $email . "' AND `product_id`='" . $product_id . "'");
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

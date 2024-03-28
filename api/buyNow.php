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
        if (isset($_SESSION["user"])) {
            if (isset($_GET["id"]) && isset($_GET["qty"])) {
                $product_id = $_GET["id"];
                $product_qty = $_GET["qty"];
                $product_data = $this->getProductById($product_id);
                if ($product_data) {
                    $email = $_SESSION["user"]["email"];
                    $user = $this->getUserByEmail($email);
                    if ($user) {
                        $address = $this->getUserAddress($email);
                        if ($address) {
                            $this->buyProduct($user, $address, $product_data, $product_qty);
                        } else {
                            $this->responseObj->error = "Please update your profile to purchase a product.";
                            $this->sendResponse(400);
                        }
                    } else {
                        $this->responseObj->error = "User not found.";
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
        } else {
            $this->responseObj->error = "Please Login first to purchase a product.";
            $this->sendResponse(400);
        }
    }

    private function buyProduct($user, $address, $product_data, $product_qty)
    {
        $array = array();

        $order_id = uniqid();
        $merchant_id = 1225556;
        $merchant_secret = "NjQ4MjExMTQzMTAyODk1NDI3MTIzMDk2NjEyMzEzMDYzNDQyNjc3";
        $currency = 'LKR';
        $delivery = 0;
        if ($address["district_name"] == "Colombo") {
            $delivery = $product_data["delivery_fee_colombo"];
        } else {
            $delivery = $product_data["delivery_fee_other"];
        }
        $amount = ((int)$product_data["price"] * (int)$product_qty) + (int)$delivery;
        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $array["fname"] = $user["fname"];
        $array["lname"] = $user["lname"];
        $array["email"] = $user["email"];
        $array["mobile"] = $user["mobile"];
        $array["address"] = $address["line1"] . " " . $address["line2"];
        $array["city"] = $address["city_name"];
        $array["item"] = $product_data["title"];
        $array["order_id"] = $order_id;
        $array["amount"] = $amount;
        $array["currency"] = $currency;
        $array["hash"] = $hash;
        $array["merchant_secret"] = $merchant_secret;
        $array["merchant_id"] = $merchant_id;

        $this->responseObj->msg = "Success";
        $this->responseObj->requiredData = $array;
        $this->sendResponse();
    }

    private function getProductById($product_id)
    {
        $result = $this->search("SELECT * FROM `product` WHERE `id`='" . $product_id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getUserAddress($email)
    {
        $result = $this->search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `city`.`id`=`user_has_address`.`city_id` 
        INNER JOIN `district` ON `district`.`id`=`city`.`district_id` WHERE `user_email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
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

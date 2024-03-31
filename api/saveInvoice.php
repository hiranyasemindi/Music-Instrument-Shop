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
            $this->responseObj->error = "Invalid Request Method.";
            $this->sendResponse(400);
        }
    }

    private function handlePOSTRequest()
    {
        if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            if (json_last_error() == JSON_ERROR_NONE) {
                if (isset($_SESSION["user"])) {
                    $email = $_SESSION["user"]["email"];
                    $user = $this->getUserByEmail($email);
                    if ($user) {
                        $this->saveInvoice($decoded, $user);
                    } else {
                        $this->responseObj->error = "User not found.";
                        $this->sendResponse(400);
                    }
                } else {
                    $this->responseObj->error = "Please Login to continue.";
                    $this->sendResponse(400);
                }
            } else {
                $this->responseObj->error = "Invalid JSON.";
                $this->sendResponse(400);
            }
        } else {
            $this->responseObj->error = "Invalid Content-Type.";
            $this->sendResponse(400);
        }
    }

    private function saveInvoice($decoded, $user)
    {
        $productArray = $decoded["productArray"];
        $date = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $date->setTimezone($tz);
        $today = $date->format("Y-m-d H:i:s");
        $orderId = $decoded["orderId"];
        $amount = $decoded["amount"];
        $this->insertToInvoice($orderId, $today,  $user["email"], $amount);

        $invoiceProductArray = array();
        $ItemId = 0;
        foreach ($productArray as $product) {
            // echo "id ".$product["id"];
            $productData = $this->getProductById($product["id"]);
            if ($productData) {
                // echo $product["id"];
                // echo $productData["qty"];
                $currentQty = $productData["qty"];
                $newQty = (int)$currentQty - (int)$product["quantity"];
                $this->updateQty($newQty, $product["id"]);
                $this->insertToInvoiceItem($product["quantity"], $product["id"], $orderId);
                $invoiceProductObj = new stdClass();
                $invoiceProductObj->item = $product["title"];
                $invoiceProductObj->price = $product["price"];
                $invoiceProductObj->quantity = $product["quantity"];
                $invoiceProductObj->amount = (int)$product["price"] * (int)$product["quantity"];
                $ItemId += 1;
                $invoiceProductObj->id = $ItemId;
                array_push($invoiceProductArray, $invoiceProductObj);
            } else {
                $this->responseObj->error = "Product not available.";
                $this->sendResponse(400);
            }
        }
        $this->sendData($user, $orderId, $today, $amount, $decoded, $invoiceProductArray);
    }

    private function sendData($user, $orderId, $today, $amount, $decoded, $invoiceProductArray)
    {
        $array = array();
        $address = $this->getUserAddress($user["email"]);
        $array["name"] = $user["fname"] . " " . $user["lname"];
        $array["address"] = $address["line1"] . " " . $address["line2"];
        $array["district"] = $address["district_name"];
        $array["email"] = $user["email"];
        $array["invoice_id"] = $orderId;
        $array["date"] = $today;
        $array["total"] = $amount;
        $array["subtotal"] = $decoded["subtotal"];
        $array["shipping"] = $decoded["shipping"];
        $array["productArray"] = $invoiceProductArray;
        $this->responseObj->invoiceData = $array;
        $this->responseObj->msg = "Success";
        $this->sendResponse();
    }

    private function getUserAddress($email)
    {
        $result = $this->search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `city`.`id`=`user_has_address`.`city_id` 
        INNER JOIN `district` ON `district`.`id`=`city`.`district_id` WHERE `user_email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function insertToInvoiceItem($qty, $id, $order_id)
    {
        $this->iud("INSERT INTO `invoice_item` (`qty`,`product_id`,`invoice_order_id`) VALUES('" . $qty . "','" . $id . "','" . $order_id . "')");
    }

    private function insertToInvoice($orderId, $today, $email, $amount)
    {
        $this->iud("INSERT INTO `invoice` (`order_id`,`date_selled`,`user_email`,`total`) VALUES('" . $orderId . "','" . $today . "','" . $email . "','" . $amount . "')");
    }

    private function getProductById($product_id)
    {
        $result = $this->search("SELECT * FROM `product` WHERE `id`='" . $product_id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function updateQty($qty, $id)
    {
        $this->iud("UPDATE `product` SET `qty`='" . $qty . "' WHERE `id`='" . $id . "'");
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

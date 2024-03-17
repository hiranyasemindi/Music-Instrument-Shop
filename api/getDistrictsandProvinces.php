<?php
require_once "../libs/connection.php";

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
        if (isset($_GET["id"])) {
            $city_id = $_GET["id"];
            $details = $this->getCityDistrictProvince($city_id);
            if ($details) {
                $this->responseObj->district_id = $details["district_id"];
                $this->responseObj->district_name = $details["district_name"];
                $this->responseObj->province_id = $details["province_id"];
                $this->responseObj->province_name = $details["province_name"];
                $this->responseObj->msg = "Success";
                $this->sendResponse();
            } else {
                $this->responseObj->error = "No such city.";
                $this->sendResponse(400);
            }
        } else {
            $this->responseObj->error = "Requested parameters are empty.";
            $this->sendResponse(400);
        }
    }

    private function getCityDistrictProvince($city_id)
    {
        $result = $this->search("SELECT * FROM `city` INNER JOIN `district` ON `district`.`id`=`city`.`district_id` 
        INNER JOIN `province` ON `province`.`id`=`district`.`province_id` WHERE `city`.`id`='" . $city_id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function sendResponse($statusCode = 200)
    {
        http_response_code($statusCode);
        echo json_encode($this->responseObj);
    }

    private function search($q)
    {
        return Database::search($q);
    }
}

$process = new Process();
$process->handleRequest();

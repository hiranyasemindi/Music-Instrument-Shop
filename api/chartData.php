<?php
require_once "../libs/connection.php";
session_start();

$process = new Process();
$process->checkAdmin();

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
            $this->checkAdmin();
        } else {
            $this->responseObj->error = "Invalid request Method.";
            $this->sendResponse(400);
        }
    }

    public function checkAdmin()
    {
        if ($_SESSION["admin"]) {
            $email = $_SESSION["admin"]["email"];
            $admin = $this->getAdminByEmail($email);
            if ($admin) {
                $array = array_fill(1, 12, 0);
                $pendingCount = $this->getPendingOrderCount();
                $completedCount = $this->getCompletedOrderCount();
                $Earnings = $this->getTotalForEachMonth();
                if ($Earnings !== null) {
                    while ($earningData = $Earnings->fetch_assoc()) {
                        $month = (int)date('m', strtotime($earningData['month']));
                        $array[$month] = $earningData['total_per_month'];
                    }
                }
                $this->responseObj->pendingCount = $pendingCount["Pending"];
                $this->responseObj->completedCount = $completedCount["Completed"];
                $this->responseObj->earnings = $array;
                $this->sendResponse(400);
            } else {
                include "404.php";
            }
        } else {
            include "App/views/notLogged_user_templete.php";
        }
    }

    private function getPendingOrderCount()
    {
        $result = $this->search("SELECT COUNT(`order_id`) AS `Pending` FROM `invoice` WHERE `deliver_status_id`='1'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getCompletedOrderCount()
    {
        $result = $this->search("SELECT COUNT(`order_id`) AS `Completed` FROM `invoice` WHERE `deliver_status_id`='2'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getTotalForEachMonth()
    {
        $result = $this->search("SELECT DATE_FORMAT(date_selled,'%Y-%M') AS month, SUM(total) AS total_per_month FROM invoice GROUP BY DATE_FORMAT(date_selled, '%Y-%M')");
        return $result->num_rows > 0 ? $result : null;
    }


    private function getAdminByEmail($email)
    {
        $result = $this->search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
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

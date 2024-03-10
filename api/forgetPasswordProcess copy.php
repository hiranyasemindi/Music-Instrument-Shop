<?php
require_once "../libs/connection.php";


class Process
{

    private function __construct()
    {
        $this->responseObj = new stdClass();
    }

    private function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'GET') {
            $this->handleGETRequest();
        } else if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $this->handlePOSTRequest();
        }else{
            
        }
    }

    private function handleGETRequest()
    {
    }

    private function handlePOSTRequest()
    {
    }
}


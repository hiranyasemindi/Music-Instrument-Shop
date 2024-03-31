<?php
require_once "libs/connection.php";
include "empty.php";

session_start();

$process = new Process();
$process->handleRequest();
class Process
{
    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->handleGETRequest();
        } else {
            include "404.php";
        }
    }

    private function handleGETRequest()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $this->products($id);
        } else {
            include "404.php";
        }
    }

    private function products($id)
    {
        $products = $this->getProductsByCategory($id);
        $categories = $this->getCategories();
        $brands = $this->getBrands();
        $models = $this->getModels();
        $colors = $this->getColors();
        if ($products) {
            include "App/views/productsTemplete.php";
            ProductsTemplete::generate($products, $categories, $brands, $models, $colors,);
        } else {
            EmptyDesign::generate("Products not Available.");
        }
    }

    private function getProductsByCategory($id)
    {
        $result = $this->search("SELECT * FROM `product` WHERE `category_id`='" . $id . "'");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getCategories()
    {
        $result =  $this->search("SELECT * FROM `category`");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getBrands()
    {
        $result =  $this->search("SELECT * FROM `brand`");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getModels()
    {
        $result =  $this->search("SELECT * FROM `model`");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getColors()
    {
        $result =  $this->search("SELECT * FROM `color`");
        return $result->num_rows > 0 ? $result : null;
    }

    private function search($q)
    {
        return Database::search($q);
    }

}

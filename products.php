<?php
require_once "libs/connection.php";
session_start();

$process = new Process();
$process->products();
class Process
{
    public function products()
    {
        $products = $this->getProducts();
        $categories = $this->getCategories();
        $brands = $this->getBrands();
        $models = $this->getModels();
        $colors = $this->getColors();
        if ($products) {
            include "App/views/productsTemplete.php";
            ProductsTemplete::generate($products, $categories, $brands, $models, $colors,);
        } else {
            echo "products not available";
        }
    }

    private function getProducts()
    {
        $result =  $this->search("SELECT * FROM `product` WHERE `status_id`='1' ");
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

    private function iud($q)
    {
        Database::iud($q);
    }
}

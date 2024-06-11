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
        $colors = $this->getColors();
        $categories = $this->getCategories();

        if ($products) {
            if (isset($_GET["category_id"])) {
                $modelsAndBrands = $this->getBrandsAndModelsByCategory($_GET["category_id"]);
                include "App/views/productsTemplete.php";
                BrandModelsTemplete::generate($modelsAndBrands, $modelsAndBrands, 0);
            } else {
                $brands = $this->getBrands();
                $models = $this->getModels();

                include "App/views/productsTemplete.php";
                ProductsTemplete::generate($products, $categories, $brands, $models, $colors,);
            }
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
        $result =  $this->search("SELECT `id` AS `brand_id`,`brand_name` FROM `brand`");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getModels()
    {
        $result =  $this->search("SELECT `id` AS `model_id`,`model_name` FROM `model`");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getColors()
    {
        $result =  $this->search("SELECT * FROM `color`");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getBrandsAndModelsByCategory($cid)
    {
        $result = $this->search("SELECT `brand_id`,`brand_name`,`model_id`,`model_name` FROM `product` INNER JOIN `brand_has_model` ON `brand_has_model`.`id`=`product`.`brand_has_model_id`
        INNER JOIN `brand` ON `brand`.`id`=`brand_has_model`.`brand_id`
        INNER JOIN `model` ON `model`.`id`=`brand_has_model`.`model_id` WHERE `product`.`category_id`='" . $cid . "'");
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

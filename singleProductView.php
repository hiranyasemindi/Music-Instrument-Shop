<?php
require_once "libs/connection.php";

class Process
{
    public function checkProduct()
    {
        if (isset($_GET["id"])) {
            $product_id = $_GET["id"];
            $product = $this->getProductById($product_id);
            $relatedItems = $this->getRelatedItems($product["brand_id"]);
            include "App/views/singleProduct_templete.php";
            SignleProductTemplete::generate($product, $relatedItems);
        } else {
            include "../Music_Shop/404.php";
        }
    }

    private function getProductById($id)
    {
        $result = $this->search("SELECT * FROM `product` INNER JOIN `condition` ON `product`.`condition_id`=`condition`.`id` 
        INNER JOIN `brand_has_model` ON `brand_has_model`.`id`=`product`.`brand_has_model_id` INNER JOIN `brand` ON `brand`.`id`=`brand_has_model`.`brand_id` 
        INNER JOIN `model` ON `model`.`id`=`brand_has_model`.`model_id` WHERE `product`.`id`='" . $id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getRelatedItems($brand_id)
    {
        $result = $this->search("SELECT * FROM `product` INNER JOIN `condition` ON `product`.`condition_id`=`condition`.`id` 
        INNER JOIN `brand_has_model` ON `brand_has_model`.`id`=`product`.`brand_has_model_id` INNER JOIN `brand` ON `brand`.`id`=`brand_has_model`.`brand_id` 
        INNER JOIN `model` ON `model`.`id`=`brand_has_model`.`model_id` WHERE `brand`.`id`='" . $brand_id . "' LIMIT 4");
        return $result->num_rows > 0 ? $result : null;
    }

    private function search($q)
    {
        return Database::search($q);
    }
}

$process = new Process();
$process->checkProduct();

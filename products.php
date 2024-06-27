<?php
require_once "libs/connection.php";
session_start();

$process = new ProductProcess();
$process->products();
class ProductProcess
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
            } else if (isset($_GET["brand_id"])) {
                $models = $this->getModelsByBrands($_GET["brand_id"]);
                include "App/views/productsTemplete.php";
                BrandModelsTemplete::generateModels($models, 1);
            } else {
                $brands = $this->getBrands();
                $models = $this->getModels();
                $query = "SELECT * FROM `product`";
                // echo json_encode($_GET);
                if ($_GET == [] || count($_GET) === 1 && isset($_GET['page'])) {
                    include "App/views/productsTemplete.php";
                    ProductsTemplete::generate($query, $categories, $brands, $models, $colors);
                } else {
                    $sort = $_GET["sort"];
                    $category_id = $_GET["category"];
                    $brand_id = $_GET["brand"];
                    $model_id = $_GET["model"];
                    $min = $_GET["minPrice"];
                    $max = $_GET["maxPrice"];
                    $color_id = $_GET["color"];
                    $rating = $_GET["rate"];
                    $status = 0;

                    if ($category_id != 0) {
                        $query .= "WHERE `category_id`='" . $category_id . "'";
                        $status = 1;
                    }

                    if ($brand_id != 0 && $model_id == 0) {
                        $model_has_brand = $this->getModelhasBrandIdByBrandId($brand_id);
                        $ids = "";
                        if ($model_has_brand) {

                            while ($mb = $model_has_brand->fetch_assoc()) {
                                $ids .= $mb["id"] . ",";
                            }
                            $ids = rtrim($ids, ",");

                            if ($status == 0) {
                                $query .= "WHERE `brand_has_model_id` IN (" . $ids . ")";
                                $status = 1;
                            } else {
                                $query .= " AND `brand_has_model_id`IN (" . $ids . ")";
                            }
                        }
                    }

                    if ($brand_id == 0 && $model_id != 0) {
                        $model_has_brand = $this->getModelhasBrandIdByModelId($model_id);
                        $ids = "";
                        if ($model_has_brand) {

                            while ($mb = $model_has_brand->fetch_assoc()) {
                                $ids .= $mb["id"] . ",";
                            }
                            $ids = rtrim($ids, ",");

                            if ($status == 0) {
                                $query .= "WHERE `brand_has_model_id` IN (" . $ids . ")";
                                $status = 1;
                            } else {
                                $query .= " AND `brand_has_model_id`IN (" . $ids . ")";
                            }
                        }
                    }

                    if ($brand_id != 0 && $model_id != 0) {
                        $model_has_brand = $this->getModelhasBrandId($model_id, $brand_id);
                        $ids = "";
                        if ($model_has_brand) {

                            while ($mb = $model_has_brand->fetch_assoc()) {
                                $ids .= $mb["id"] . ",";
                            }
                            $ids = rtrim($ids, ",");

                            if ($status == 0) {
                                $query .= "WHERE `brand_has_model_id` IN (" . $ids . ")";
                                $status = 1;
                            } else {
                                $query .= " AND `brand_has_model_id`IN (" . $ids . ")";
                            }
                        }
                    }

                    if (!empty($min) && empty($max)) {
                        if ($status == 0) {
                            $query .= "WHERE `price`>='" . $min . "'";
                            $status = 1;
                        } else {
                            $query .= " AND `price`>='" . $min . "'";
                        }
                    }

                    if (empty($min) && !empty($max)) {
                        if ($status == 0) {
                            $query .= "WHERE `price`<='" . $max . "'";
                            $status = 1;
                        } else {
                            $query .= " AND `price`<='" . $max . "'";
                        }
                    }

                    if (!empty($min) && !empty($max)) {
                        if ($status == 0) {
                            $query .= "WHERE `price` BETWEEN '" . $min . "' AND '" . $max . "'";
                            $status = 1;
                        } else {
                            $query .= " AND `price` BETWEEN '" . $min . "' AND '" . $max . "'";
                        }
                    }

                    if ($color_id) {
                        $products = $this->getProductsByColorId($color_id);
                        $ids = "0";
                        if ($products) {
                            while ($product = $products->fetch_assoc()) {
                                $ids .= $product["product_id"] . ",";
                            }
                            $ids = rtrim($ids, ",");
                        }
                        if ($status == 0) {
                            $query .= "WHERE `id` IN (" . $ids . ")";
                            $status = 1;
                        } else {
                            $query .= " AND `id`IN (" . $ids . ")";
                        }
                    }

                    if ($rating) {
                        if ($status == 0) {
                            $query .= "WHERE `rating`= '" . $rating . "'";
                            $status = 1;
                        } else {
                            $query .= " AND `rating`= '" . $rating . "'";
                        }
                    }

                    switch ($sort) {
                        case 1:
                            $query .= " ORDER BY `price` ASC";
                            break;
                        case 2:
                            $query .= " ORDER BY `price` DESC";
                            break;
                        case 3:
                            $query .= " ORDER BY `qty` ASC";
                            break;
                        case 4:
                            $query .= " ORDER BY `qty` DESC";
                            break;
                        default:
                            $query .= "";
                    }
                    include "App/views/productsTemplete.php";
                    // echo $query;
                    ProductsTemplete::generate($query, $categories, $brands, $models, $colors);
                }
            }
        } else {
            echo "products not available";
        }
    }


    private function getProductsByColorId($cid)
    {
        $result = $this->search("SELECT * FROM `product_has_color` WHERE `color_id`='" . $cid . "'");
        return $result->num_rows > 0 ? $result : null;
    }


    private function getModelhasBrandIdByBrandId($bid)
    {
        $result = $this->search("SELECT * FROM `brand_has_model` WHERE `brand_id`='" . $bid . "'");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getModelhasBrandIdByModelId($mid)
    {
        $result = $this->search("SELECT * FROM `brand_has_model` WHERE `model_id`='" . $mid . "'");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getModelhasBrandId($mid, $bid)
    {
        $result = $this->search("SELECT * FROM `brand_has_model` WHERE `model_id`='" . $mid . "' AND `brand_id`='" . $bid . "'");
        return $result->num_rows > 0 ? $result : null;
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

    public function getProductsLimit($limit, $offset)
    {
        $result = $this->search("SELECT * FROM `product` WHERE `status_id`='1' LIMIT " . $limit . " OFFSET " . $offset . "");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getModelsByBrands($bid)
    {
        $result = $this->search("SELECT `brand_id`,`model_id`,`model_name` FROM `brand_has_model` INNER JOIN `model` ON `model`.`id`=`brand_has_model`.`model_id` WHERE `brand_id`=" . $bid . "");
        return $result->num_rows > 0 ? $result : null;
    }



    private function search($q)
    {
        return Database::search($q);
    }
}

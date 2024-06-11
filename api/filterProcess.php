<?php
require_once "../libs/connection.php";
include "../App/views/productsTemplete.php";
include "../empty.php";

class Process
{

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handlePOSTRequest();
        } else {
            echo "error";
        }
    }

    private function handlePOSTRequest()
    {
        if ($_SERVER["CONTENT_TYPE"] == "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content);
            if (json_last_error() == JSON_ERROR_NONE) {
                $this->filter($decoded);
            } else {
                // include "../404.php";
                echo "error";
            }
        } else {
            echo "error";
        }
    }

    private function filter($decoded)
    {
        $category_id = $decoded->category;
        $brand_id = $decoded->brand;
        $model_id = $decoded->model;
        $min = $decoded->min;
        $max = $decoded->max;
        $color_id = $decoded->color;
        $rating = $decoded->rating;
        $sort = $decoded->sort;

        $query = "SELECT * FROM `product` ";
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
                } else {
                    $query .= " AND `brand_has_model_id`IN (" . $ids . ")";
                }
            }
        }

        if (!empty($min) && empty($max)) {
            if ($status == 0) {
                $query .= "WHERE `price`>='" . $min . "'";
            } else {
                $query .= " AND `price`>='" . $min . "'";
            }
        }

        if (empty($min) && !empty($max)) {
            if ($status == 0) {
                $query .= "WHERE `price`<='" . $max . "'";
            } else {
                $query .= " AND `price`<='" . $max . "'";
            }
        }

        if (!empty($min) && !empty($max)) {
            if ($status == 0) {
                $query .= "WHERE `price` BETWEEN '" . $min . "' AND '" . $max . "'";
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
            } else {
                $query .= " AND `id`IN (" . $ids . ")";
            }
        }

        if ($rating) {
            if ($status == 0) {
                $query .= "WHERE `rating`= '" . $rating . "'";
            } else {
                $query .= "AND `rating`= '" . $rating . "'";
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

        $filteredProducts = $this->searchProducts($query);
        if ($filteredProducts) {
            DisplayProductsTemplete::generate($filteredProducts);
        } else {
            EmptyDesign::generate("Products not Available");
        }
    }

    private function searchProducts($query)
    {
        $result = $this->search($query);
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

    private function getProductsByColorId($cid)
    {
        $result = $this->search("SELECT * FROM `product_has_color` WHERE `color_id`='" . $cid . "'");
        return $result->num_rows > 0 ? $result : null;
    }

    private function search($q)
    {
        return Database::search($q);
    }
}

$process = new Process();
$process->handleRequest();

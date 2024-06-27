<?php
require_once "../libs/connection.php";
// include "../products.php";
include "../App/views/productsTemplete.php";
include "../empty.php";

class FilterProcess
{

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->handleGETRequest();
        } else {
            echo "error";
        }
    }

    private function handleGETRequest()
    {
        if (isset($_GET["text"])) {
            $query = "SELECT * FROM `product` WHERE `title` LIKE '%" . $_GET["text"] . "%'";
            $filteredProducts = $this->searchProducts($query);
            if ($filteredProducts) {
                DisplayProductsTemplete::generate($filteredProducts->num_rows, $query);
            } else {
                EmptyDesign::generate("Products not Available");
            }
        }
    }

    private function searchProducts($query)
    {
        $result = $this->search($query);
        return $result->num_rows > 0 ? $result : null;
    }

    private function search($q)
    {
        return Database::search($q);
    }
}

$process = new FilterProcess();
$process->handleRequest();

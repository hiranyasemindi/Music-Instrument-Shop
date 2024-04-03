<?php
require_once "libs/connection.php";
session_start();

$process = new Process();
$process->checkAdmin();

class Process
{
    public function checkAdmin()
    {
        if ($_SESSION["admin"]) {
            $email = $_SESSION["admin"]["email"];
            $admin = $this->getAdminByEmail($email);
            if ($admin) {
                $categories = $this->getCategories();
                $brands = $this->getBrands();
                $models = $this->getModels();
                $product = null;
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $product = $this->getProductById($id);
                    if ($product) {
                        SingleProductTemplete::generate($product, $categories, $brands, $models);
                    } else {
                        include "404.php";
                    }
                } else {
                    SingleProductTemplete::generate($product, $categories, $brands, $models);
                }
            } else {
                include "404.php";
            }
        } else {
            include "App/views/notLogged_user_templete.php";
        }
    }

    private function getProductById($id)
    {
        $result = $this->search("SELECT * FROM `product` INNER JOIN `brand_has_model` ON `brand_has_model`.`id`=`product`.`brand_has_model_id` WHERE `product`.`id`='" . $id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getAdminByEmail($email)
    {
        $result = $this->search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
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

    private function search($q)
    {
        return Database::search($q);
    }

    private function iud($q)
    {
        Database::iud($q);
    }
}
?>

<?php
class SingleProductTemplete
{
    public static function generate($product, $categories, $brands, $models)
    {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dashboard | ADMIN</title>
            <link rel="icon" href="logo//logoo.png">
            <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <link rel="stylesheet" type="text/css" href="https://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
        </head>

        <body class="bg-[#f2f2f2]">
            <style>
                .table td,
                .table th {
                    padding-top: 20px;
                    /* Adjust as needed */
                    padding-bottom: 20px;
                    /* Adjust as needed */
                }
            </style>
            <div class="container-fluid vh-100">
                <div class="row">
                    <!-- Left area  -->
                    <?php
                    include "App/includes/adminDshboardMenu.php";
                    ?>
                    <!-- Left area  -->

                    <div class=" lg:w-[82%] h-[5rem] bg-white ">

                        <!-- header -->
                        <?php
                        include "App/includes/adminDashbordHeader.php";
                        AdminHeaderTemplete::generate();

                        ?>
                        <!-- header -->

                        <!-- Add product -->
                        <div class="row mt-4 " style="overflow-y: scroll; height:44rem;">
                            <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                                <span class=" text-2xl text-[#AD1212] fw-semibold"><?php echo $product ? "Edit" : "Add"; ?> Product</span>
                            </div>
                            <div class="w-[86%] bg-white pt-2 ps-5 pb-4 pe-5 ml-[7%] ">
                                <div class="flex  items-center p-4 d-none text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" id="product_alertBox" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div id="product_alert">
                                        <span class="font-medium">Warning!</span> Change a few things up and try submitting again.
                                    </div>
                                </div>
                            </div>
                            <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                                <div class="row">
                                    <div class="col-4 justify-center mb-5 ">
                                        <img id="viewProductImg" src="<?php echo $product ? $product["image_path"] : "assets/img/upload.png"; ?>" class="border w-[90%]" alt="prmo_img" width="400px" height="400px">
                                        <div class="bg-[#555657] w-[90%] text-center py-[13px] hover:cursor-pointer">
                                            <input <?php echo $product ? "disabled" : ""; ?> type="file" class="d-none" id="productImage" accept="image/*" />
                                            <label onclick="changeProductImage();" for="productImage" class="text-white"><i class="bi bi-upload me-3"></i>Upload Image</label>
                                        </div>
                                    </div>
                                    <div class="col-8 ">
                                        <div class="row">
                                            <select id="cat" <?php echo $product ? "disabled" : ""; ?> class="lg:w-[32%] me-[2%] disabled border h-[40%]  focus:outline-none p-3 ">
                                                <option value="0">Select Category</option>
                                                <?php
                                                while ($category = $categories->fetch_assoc()) {
                                                ?>
                                                    <option <?php if ($product) {
                                                                echo $category["id"] == $product["category_id"] ? "selected" : "";
                                                            } ?> value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <select id="br" <?php echo $product ? "disabled" : ""; ?> class=" lg:w-[32%]  me-[2%] border h-[40%] p-3 focus:outline-none ">
                                                <option value="0">Select Brand</option>
                                                <?php
                                                while ($brand = $brands->fetch_assoc()) {
                                                ?>
                                                    <option <?php if ($product) {
                                                                echo $brand["id"] == $product["brand_id"] ? "selected" : "";
                                                            }  ?> value="<?php echo $brand["id"]; ?>"><?php echo $brand["brand_name"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <select id="md" <?php echo $product ? "disabled" : ""; ?> class="lg:w-[32%]  border h-[40%] p-3  focus:outline-none ">
                                                <option value="0">Select Model</option>
                                                <?php
                                                while ($model = $models->fetch_assoc()) {
                                                ?>
                                                    <option <?php if ($product) {
                                                                echo $model["id"] == $product["model_id"] ? "selected" : "";
                                                            }  ?> value="<?php echo $model["id"]; ?>"><?php echo $model["model_name"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <input id="tit" <?php echo $product ? "disabled" : ""; ?> class="border h-[40%] p-3 mt-4 focus:outline-none mt-3" type="text" value="<?php echo $product ? $product["title"] : ""; ?>" placeholder="Title">
                                            <textarea <?php echo $product ? "disabled" : ""; ?> placeholder="Description" class="border p-3 mt-4 focus:outline-none mt-3" name="" id="des" cols="30" rows="10"><?php echo $product ? $product["description"] : ""; ?></textarea>
                                            <span class="w-[49%] mb-2 font-medium mt-4 me-[1%]">Price:</span><span class="w-[49%] font-medium mb-2 mt-4 ms-[1%]">Qty :</span>

                                            <input id="pr" <?php echo $product ? "disabled" : ""; ?> class="border w-[49%] me-[1%] h-[40%] p-3  focus:outline-none" type="number" placeholder="Price" value="<?php echo $product ? $product["price"] : ""; ?>">
                                            <input id="qt" <?php echo $product ? "disabled" : ""; ?> class="border w-[49%] ms-[1%] h-[40%] p-3  focus:outline-none " type="number" placeholder="Quantity" value="<?php echo $product ? $product["qty"] : ""; ?>">
                                            <span class="w-[49%] mb-2 mt-4 me-[1%] font-medium">Delivery Fee Colombo :</span><span class="w-[49%] font-medium mb-2 mt-4 ms-[1%]">Delivery Fee out of Colombo :</span>
                                            <input id="dfc" <?php echo $product ? "disabled" : ""; ?> class="border w-[49%] me-[1%] h-[40%] p-3  focus:outline-none " type="number" placeholder="Delivery Fee Colombo" value="<?php echo $product ? $product["delivery_fee_colombo"] : ""; ?>">
                                            <input id="dfo" <?php echo $product ? "disabled" : ""; ?> class="border w-[49%] ms-[1%] h-[40%] p-3  focus:outline-none " type="number" placeholder="Delivery Fee Out of Colombo" value="<?php echo $product ? $product["delivery_fee_other"] : ""; ?>">
                                            <div class="mt-3 text-center">
                                                <?php
                                                if ($product) {
                                                ?>
                                                    <button id="editProductBtn" class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded " onclick="editProduct();">Edit Product</button>
                                                    <button onclick="updateProduct(<?php echo $product['id']; ?>);" id="updateProductBtn" class="bg-[#AD1212] w-[40%] d-none text-white p-[14px] rounded ">Update Product</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button onclick="addProduct();" class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Add Product</button>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add product -->

                    </div>

                </div>
            </div>


            <script src="assets/js/script.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script>
                function addProductPage() {
                    localStorage.setItem("activeMenuItem", "");
                    window.location.href = 'adminSinglePromotion';
                }
            </script>
        </body>

        </html>
<?php
    }
}
?>
<?php
session_start();
require_once "libs/connection.php";

$process = new Process();
$process->checkUser();
class Process
{
    public function checkUser()
    {
        if (isset($_SESSION["user"])) {
            $orders = $this->getInvoiceData($_SESSION["user"]["email"]);
            $address =  $this->getUserAddress($_SESSION["user"]["email"]);
            $userRatings = $this->getUserRatings();
            PurchaseHistoryTemplete::generate($orders, $address, $userRatings);
        } else {
            include "App/views/notLogged_user_templete.php";
        }
    }

    private function getUserRatings()
    {
        $result = $this->search("SELECT * FROM `ratings` WHERE `user_email`='" . $_SESSION["user"]["email"] . "'");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getInvoiceData($email)
    {
        $result = $this->search("SELECT * FROM `invoice` WHERE `user_email`='" . $email . "' ORDER BY `date_selled` DESC");
        return $result->num_rows > 0 ? $result : null;
    }

    public function getInvoiceItems($order_id)
    {
        $result = $this->search("SELECT `product_id`,`title`,`condition`,`price`,`image_path`,`invoice_item`.`qty`,`delivery_fee_colombo`,`delivery_fee_other`,`rating`,`product`.`id` FROM `invoice_item` INNER JOIN `product` ON `product`.`id`=`invoice_item`.`product_id` INNER JOIN `condition`
        ON `condition`.`id`=`product`.`condition_id` WHERE `invoice_order_id`='" . $order_id . "'");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getUserAddress($email)
    {
        $result = $this->search("SELECT `district_name` FROM `user_has_address` INNER JOIN `city` ON `city`.`id`=`user_has_address`.`city_id` 
        INNER JOIN `district` ON `district`.`id`=`city`.`district_id` WHERE `user_email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function search($q)
    {
        return Database::search($q);
    }
}

?>


<?php
class PurchaseHistoryTemplete
{
    public static function generate($orders, $address, $userRatings)
    {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Purchase History | SONORITY</title>
            <link rel="icon" href="logo//logoo.png">
            <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        </head>

        <body>

            <?php include "App/includes/header.php"; ?>

            <div class="container-fluid mb-5">
                <div class="row">

                    <div class="col-12">
                        <div class="row">

                            <div class="p-4 mt-4 pt-lg--5">
                                <h2 class="text-3xl pslg--4 font-bold">Purchasing History</h2>
                                <div class="bg-[#AD1212] my-3 h-1 w-[25%] d-none d-lg-block ml-[2%] rounded"></div>
                                <div class="bg-[#AD1212] my-2 h-[2px] w-[90%] d-block d-lg-none ml-[2%] rounded"></div>
                            </div>

                            <div class="col-12  ">
                                <div class="row">
                                    <div class=" col-12">
                                        <div class="row">
                                            <?php
                                            if ($orders) {
                                                foreach ($orders as $order) {
                                            ?>
                                                    <!-- lg screen -->
                                                    <div class="col-10 offset-1  mt-4 d-none d-lg-block">
                                                        <div class="row">
                                                            <div class="border py-2 col-12 ">
                                                                <div class="row">
                                                                    <div class="text-start col-3">
                                                                        <span class="text-[#999b9e]"><span class="fw-semibold">Order ID :</span> <span><?php echo $order["order_id"]; ?></span></span>
                                                                    </div>
                                                                    <div class="text-end col-3">
                                                                        <span class="text-[#999b9e] text-end"><span class="fw-semibold">Date :</span> <span><?php echo $order["date_selled"]; ?></span></span>
                                                                    </div>
                                                                    <div class="text-end col-3">
                                                                        <span class="text-[#999b9e] text-end"><span class="fw-semibold">Grand Total :</span> <span>Rs.<?php echo $order["total"]; ?>.00</span></span>
                                                                    </div>
                                                                    <div class="text-end col-3">
                                                                        <span class="text-[#999b9e] text-end"><span class="fw-semibold">Deliver Status :</span> <span><?php echo $order["deliver_status_id"] == 1 ? "Pending" : "Delivered"; ?></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="border">
                                                                <div class="row">
                                                                    <?php
                                                                    $process = new Process();
                                                                    $invoiceItems = $process->getInvoiceItems($order["order_id"]);
                                                                    foreach ($invoiceItems as $item) {
                                                                    ?>
                                                                        <div class="p-4 w-[15%] ">
                                                                            <img src="<?php echo $item["image_path"]; ?>" class="border" width="150px" height="100px" alt="">
                                                                        </div>
                                                                        <div class="w-[40%]  flex items-center px-4">
                                                                            <div class="row">
                                                                                <p class="fw-semibold text-xl"><?php echo $item["title"]; ?></p><br>
                                                                                <p class="mt-4 text-xl">Rs <?php echo $item["price"]; ?>.00</p>
                                                                                <p class="text-[#999b9e] mt-2">Condition: <?php echo $item["condition"]; ?></p>
                                                                                <?php
                                                                                $df = $address["district_name"] == "Colombo" ? $item["delivery_fee_colombo"] : $item["delivery_fee_other"];
                                                                                ?>
                                                                                <p class="mt-2">Delivery Fee: Rs <?php echo $df; ?>.00</p>
                                                                                <!-- <p class="mt-4 fw-semibold text-lg">Total: Rs 20,300.00</p> -->
                                                                            </div>
                                                                        </div>

                                                                        <div class="w-[15%] flex items-center justify-center px-4">
                                                                            <div class="row">
                                                                                <p class="mt-4 fw-semibold text-lg">Quantity: <?php echo $item["qty"]; ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="w-[15%] flex items-center px-4">
                                                                            <div class="row">
                                                                                <p class="mt-4 text-[#AD1212]  fw-semibold text-lg">Total: Rs <?php echo ((int)$item["qty"] * (int)$item["price"]) + (int)$df; ?>.00</p>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                        $fill = 0;
                                                                        if ($userRatings) {
                                                                            foreach ($userRatings as $userrating) {
                                                                                if ($userrating["product_id"] === $item["product_id"]) {
                                                                                    $fill = $userrating["rating"];
                                                                                }
                                                                            }
                                                                        }

                                                                        ?>
                                                                        <div class=" w-[15%] flex items-center px-4 mt-4">
                                                                            <span class="text-center me-2 text-lg-end fw-bold" style="color: #AD1212;"><?php echo $fill; ?>.0</span>

                                                                            <span class=" ">
                                                                                <?php
                                                                                for ($x = 0; $x < 5; $x++) {
                                                                                    $starClass = ($x < $fill) ? "bi bi-star-fill" : "bi bi-star";
                                                                                ?>
                                                                                    <i onclick="rateProduct('<?php echo $item['id']; ?>',<?php echo $x + 1; ?>);" class="<?php echo $starClass; ?> pe-1 hover:cursor-pointer" style="color: #AD1212;"></i>

                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </span>
                                                                        </div>
                                                                        <hr class="mt-2">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- lg screen -->

                                                    <!--sm screen  -->
                                                    <div class="col-12 d-block d-lg-none mt-4">
                                                        <div class="row">
                                                            <div class="border py-2">
                                                                <p class="text-[#999b9e]">1st September, 2021 at 11.30 PM</p>
                                                            </div>
                                                            <?php
                                                            foreach ($invoiceItems as $item) {
                                                            ?>
                                                                <div class="border col-12">
                                                                    <div class="row">
                                                                        <div class=" w-[20%] ml-3 mb-[60px] pb-5 flex items-center">
                                                                            <div class="card row">
                                                                                <img src="<?php echo $item["image_path"]; ?>" class="px-1 " width="150px" height="150px" alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="w-[75%] flex items-start px-4 mt-3">
                                                                            <div class="row">
                                                                                <p class="fw-semibold text-lg"><?php echo $item["title"]; ?></p><br>
                                                                                <span class=" mt-2 text-lg me-5">Rs <?php echo $item["price"]; ?>.00</span>
                                                                                <p class="text-[#999b9e] mt-1">Condition: <?php echo $item["condition"]; ?></p>
                                                                                <?php
                                                                                $df = $address["district_name"] == "Colombo" ? $item["delivery_fee_colombo"] : $item["delivery_fee_other"];
                                                                                ?>
                                                                                <p class="mt-1">Delivery Fee: Rs <?php echo $df; ?>.00</p>
                                                                                <p class="mt-3 fw-semibold text-md">Quantity: <?php echo $item["qty"]; ?></p>
                                                                                <p class="my-2  text-[#AD1212]  fw-semibold text-lg">Total: Rs <?php echo ((int)$item["qty"] * (int)$item["price"]) + (int)$df; ?>.00</p>
                                                                            </div>

                                                                            <hr class="mt-3">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                    <!--sm screen  -->

                                            <?php
                                                }
                                            } else {
                                                include "empty.php";
                                                EmptyDesign::generate("You Have Nothing Purchased.");
                                            }

                                            ?>
                                        </div>
                                    </div>


                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
            </div>

            <?php include "App/includes/footer.php"; ?>
            <script src="assets/js/script.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </body>

        </html>
<?php


    }
}
?>
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
                $order = null;
                $id = $_GET["id"];
                $orderDetails = $this->getOrderDetailsById($id);
                $orderItems = $this->getItemsById($id);
                if ($orderDetails) {
                    if ($orderItems) {
                        SingleOrderTemplete::generate($orderDetails, $orderItems);
                    } else {
                        include "404.php";
                    }
                } else {
                    include "404.php";
                }
            } else {
                include "404.php";
            }
        } else {
            include "App/views/notLogged_user_templete.php";
        }
    }

    private function getOrderDetailsById($id)
    {
        $result = $this->search("SELECT * FROM `invoice` INNER JOIN `user` ON `user`.`email`=`invoice`.`user_email` 
        INNER JOIN `user_has_address` ON `user_has_address`.`user_email`=`user`.`email` INNER JOIN `city` ON `city`.`id`=`user_has_address`.`city_id` 
        INNER JOIN `district` ON `district`.`id`=`city`.`district_id` WHERE `order_id`='" . $id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getItemsById($id)
    {
        $result = $this->search("SELECT `image_path`,`title`,`price`,`invoice_item`.`qty`,`delivery_fee_colombo`,`delivery_fee_other` FROM `invoice` INNER JOIN `invoice_item` ON `invoice`.`order_id`=`invoice_item`.`invoice_order_id` 
        INNER JOIN `user` ON `user`.`email`=`invoice`.`user_email` INNER JOIN `product` ON `product`.`id`=`invoice_item`.`product_id`
        INNER JOIN `user_has_address` ON `user_has_address`.`user_email`=`user`.`email` WHERE `order_id`='" . $id . "'");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getAdminByEmail($email)
    {
        $result = $this->search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
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
class SingleOrderTemplete
{
    public static function generate($orderDetails, $orderItems)
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

                        <!-- single order -->
                        <div class="row mt-4 ">
                            <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                                <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Order ID : <?php echo $orderDetails["order_id"]; ?></span>
                            </div>

                            <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                                <div class="row">

                                    <div class="col-12 items-center">
                                        <div class="row">
                                            <div class="col-1">
                                                <img src="assets/img/profile_images/Hiranya_65f6eb066d59d.png" alt="">
                                            </div>
                                            <div class="col-5 items-center pt-[14px]">
                                                <span class="text-lg font-semibold"><?php echo $orderDetails["fname"] . " " . $orderDetails["lname"]; ?></span><br>
                                                <span><?php echo $orderDetails["user_email"]; ?></span>
                                            </div>
                                            <div class="col-6  text-end pt-[14px]">
                                                <span class="text-lg font-semibold">Date</span><br>
                                                <span><?php echo $orderDetails["date_selled"]; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 items-center mt-1">
                                        <div class="row">

                                            <div class="col-12  text-end items-center pt-[14px]">
                                                <span class="text-lg font-semibold">Delivery Address</span><br>
                                                <span><?php echo $orderDetails["line1"] . " " . $orderDetails["line2"]; ?></span>
                                            </div>
                                            <div class="col-12  text-end pt-[14px]">
                                                <span class="text-lg font-semibold">Total</span><br>
                                                <span>Rs <?php echo $orderDetails["total"]; ?>.00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4 px-4 pt-2 ">
                                        <div class="row">
                                            <table class="table hover:cursor-pointer">
                                                <thead class="bg-red-100 ">
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Item</th>
                                                        <th scope="col">Price</th>
                                                        <th class="text-center" scope="col">Quantity</th>
                                                        <th class="text-center" scope="col">Delivery Fee</th>
                                                        <th class="text-end" scope="col">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="">
                                                    <?php
                                                    while ($item =  $orderItems->fetch_assoc()) {
                                                    ?>
                                                        <tr class="border-[#AD1212]">
                                                            <th scope="row">
                                                                <img src="<?php echo $item["image_path"]; ?>" width="20px" height="20px" alt="">
                                                            </th>
                                                            <td><?php echo $item["title"]; ?></td>
                                                            <td>Rs <?php echo $item["price"]; ?>.00</td>
                                                            <td class="text-center"><?php echo $item["qty"]; ?></td>
                                                            <td class="text-center">Rs <?php $df = $orderDetails["district_name"] == "Colombo" ? $item["delivery_fee_colombo"] : $item["delivery_fee_other"];
                                                                                        echo $df; ?>.00</td>
                                                            <td class="text-end">
                                                                Rs <?php echo (int)$item["price"] * (int)$item["qty"] + (int)$df; ?>.00
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="mt-4 col-12 text-end">
                                        <button onclick="updateDelivery('<?php echo $orderDetails['order_id']; ?>');" class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Update Delivered Status</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- sigle order -->

                    </div>

                </div>
            </div>


            <script src="assets/js/script.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        </body>

        </html>
<?php
    }
}
?>
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
                $productsCount = $this->getProductCount();
                $usersCount = $this->getUsersCount();
                $ordersCount = $this->getOrdersCount();
                $promotionsCount = $this->getPromotionsCount();
                DashboardTemplete::generate($productsCount, $usersCount, $ordersCount, $promotionsCount);
            } else {
                include "404.php";
            }
        } else {
            include "App/views/notLogged_user_templete.php";
        }
    }

    private function getProductCount()
    {
        $result = $this->search("SELECT COUNT(`id`) AS `count` FROM `product`");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getUsersCount()
    {
        $result = $this->search("SELECT COUNT(`email`) AS `count` FROM `user`");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getOrdersCount()
    {
        $result = $this->search("SELECT COUNT(`order_id`) AS `count` FROM `invoice`");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getPromotionsCount()
    {
        $result = $this->search("SELECT COUNT(`id`) AS `count` FROM `promotions`");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
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
class DashboardTemplete
{
    public static function generate($productsCount, $usersCount, $ordersCount, $promotionsCount)
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
            <link rel="stylesheet" type="text/css" href="https://www.prepbootstrap.com/Content/shieldui-lite/dist/css/light/all.min.css" />
        </head>

        <body class="bg-[#f2f2f2]">
            <style>
                .table td,
                .table th {
                    padding-top: 20px;
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

                        <!-- dashboard -->
                        <div class="row dashboard">
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="w-[20%] h-[10rem] mt-4 bg-white flex items-center justify-center mx-[4%]">
                                        <div class="row ">
                                            <div class="col-4  bg-red-100 rounded-circle">
                                                <img src="assets/img/protection.png" class="mt-2" alt="" width="50rem" height="50rem">
                                            </div>
                                            <div class="text-start col-8">
                                                <p class="text-dark text-4xl fw-semibold"><?php echo $productsCount["count"]; ?></p>
                                                <p class="text-dark text-lg mt-1">Total Products</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-[20%] me-[4%] h-[10rem] mt-4 bg-white flex items-center justify-center">
                                        <div class="row ">
                                            <div class="col-4  bg-red-100 rounded-circle">
                                                <img src="assets/img/group.png" class="pt-[20px]" alt="" width="50rem" height="50rem">
                                            </div>
                                            <div class="text-start col-8">
                                                <p class="text-dark text-4xl fw-semibold"><?php echo $usersCount["count"]; ?></p>
                                                <p class="text-dark text-lg mt-1">Total Users</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-[20%] me-[4%] h-[10rem] mt-4 bg-white flex items-center justify-center">
                                        <div class="row ">
                                            <div class="col-4  bg-red-100 rounded-circle">
                                                <img src="assets/img/note.png" class="mt-[15px] ml-[5px]" alt="" width="50rem" height="50rem">
                                            </div>
                                            <div class="text-start col-8">
                                                <p class="text-dark text-4xl fw-semibold"><?php echo $ordersCount["count"]; ?></p>
                                                <p class="text-dark text-lg mt-1">Total Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-[20%] me-[4%] h-[10rem] mt-4 bg-white flex items-center justify-center">
                                        <div class="row ">
                                            <div class="col-4  bg-red-100 rounded-circle">
                                                <img src="assets/img/discount-tag.png" class="mt-3" alt="" width="50rem" height="50rem">
                                            </div>
                                            <div class="text-start col-8">
                                                <p class="text-dark text-4xl fw-semibold"><?php echo $promotionsCount["count"]; ?></p>
                                                <p class="text-dark text-lg mt-1"> Promotions </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4 w-[92%] ml-[4%]">
                                <div class="row">

                                    <div class="col-md-6 w-[49%] bg-white mr-[2%]">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="fw-semibold p-3 text-xl">Earnings</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div id="chart1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 w-[49%] bg-white">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="fw-semibold p-3 text-xl">Order Sumary</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div id="chart2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- dashboard -->

                    </div>

                </div>
            </div>

            <script src="assets/js/script.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script type="text/javascript" src="https://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
            <script type="text/javascript" src="https://www.prepbootstrap.com/Content/shieldui-lite/dist/js/shieldui-lite-all.min.js"></script>
            <script type="text/javascript">
                jQuery(function($) {
                    var data1 = [12, 3, 4, 2, 12, 3, 4, 17, 22, 34, 54, 67];
                    // var data2 = [3, 9, 12, 14, 22, 32, 45, 12, 67, 45, 55, 7];
                    // var data3 = [23, 19, 11, 134, 242, 352, 435, 22, 637, 445, 555, 57];
                    // var data4 = [13, 19, 112, 114, 212, 332, 435, 132, 67, 45, 55, 7];

                    $("#chart1").shieldChart({
                        exportOptions: {
                            image: false,
                            print: false
                        },
                        axisY: {
                            title: {
                                text: "Break-Down for selected quarter"
                            }
                        },
                        dataSeries: [{
                            seriesType: "line",
                            data: data1
                        }]
                    });
                });
            </script>
            <script type="text/javascript">
                jQuery(function($) {
                    var data1 = [4, 2];

                    $(function() {
                        $("#chart2").shieldChart({
                            exportOptions: {
                                image: false,
                                print: false
                            },
                            axisY: {
                                title: {
                                    text: "Break-Down for selected quarter"
                                }
                            },
                            dataSeries: [{
                                seriesType: "pie",
                                enablePointSelection: true,
                                data: data1
                            }]
                        });



                    });

                });
            </script>

        </body>

        </html>
<?php


    }
}
?>
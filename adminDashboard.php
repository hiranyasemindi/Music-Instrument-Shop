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
        </head>

        <body class="bg-[#f2f2f2]">
            <div class="container-fluid ">
                <div class="row">
                    <!-- Left area  -->
                    <?php
                    include "App/includes/adminDshboardMenu.php";
                    ?>
                    <!-- Left area  -->

                    <div class="bg-white h-[5rem] w-[82%] ">

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
                            <div class="col-12 mt-5 w-[92%] ml-[4%] ">
                                <div class="row h-[30rem] ">
                                    <div class="col-md-6 w-[49%]  mr-[2%] h-[28rem]">
                                        <h3 class="fw-semibold  ps-[5rem] pb-3 pt-4 mb-[-1rem] bg-white text-xl">Earnings</h3>
                                        <div class="h-full " id="curve_chart"></div>
                                    </div>
                                    <div class="col-md-6 w-[49%]  h-[28rem]">
                                        <h3 class="fw-semibold  ps-[5rem] pb-3 pt-4 mb-[-1rem] bg-white text-xl">Order Sumary</h3>
                                        <div class="h-full" id="piechart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- dashboard -->

                    </div>

                </div>
            </div>

            <script src="assets/js/script.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

            <script>
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    fetch("api/chartData", {
                            method: "GET"
                        })
                        .then((response) => response.text())
                        .then((data) => {
                            const object = JSON.parse(data);
                            const pending = object.pendingCount;
                            const completed = object.completedCount;

                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Pending', Number(pending)],
                                ['Completed', Number(completed)],
                            ]);

                            var options = {
                                // title: 'Summary'
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                            chart.draw(data, options);

                            //chart 2
                            var data2 = google.visualization.arrayToDataTable([
                                ['Year', 'Sales'],
                                ['Jan', Number(object.earnings[1])],
                                ['Feb', Number(object.earnings[2])],
                                ['Mar', Number(object.earnings[3])],
                                ['Apr', Number(object.earnings[4])],
                                ['May', Number(object.earnings[5])],
                                ['Jun', Number(object.earnings[6])],
                                ['Jul', Number(object.earnings[7])],
                                ['Aug', Number(object.earnings[8])],
                                ['Sep', Number(object.earnings[9])],
                                ['Oct', Number(object.earnings[10])],
                                ['Nov', Number(object.earnings[11])],
                                ['Dec', Number(object.earnings[12])],
                            ]);

                            var options2 = {
                                // title: 'Company Performance',
                                curveType: 'function',
                                legend: {
                                    position: 'bottom'
                                }
                            };

                            var chart2 = new google.visualization.LineChart(document.getElementById('curve_chart'));

                            chart2.draw(data2, options2);
                        })
                        .catch((error) => {
                            console.log("Error : " + error);
                        })

                }
            </script>

        </body>

        </html>
<?php
    }
}
?>
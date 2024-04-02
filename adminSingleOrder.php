<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | ADMIN</title>
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
                ?>
                <!-- header -->

                <!-- single order -->
                <div class="row mt-4 ">
                    <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                        <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Order ID : 6bsde3456dfg</span>
                    </div>

                    <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                        <div class="row">

                            <div class="col-12 items-center">
                                <div class="row">
                                    <div class="col-1">
                                        <img src="assets/img/profile_images/Hiranya_65f6eb066d59d.png" alt="">
                                    </div>
                                    <div class="col-5 items-center pt-[14px]">
                                        <span class="text-lg font-semibold">Hiranya Semindi</span><br>
                                        <span>hiranyagunawardhane@gmail.com</span>
                                    </div>
                                    <div class="col-6  text-end pt-[14px]">
                                        <span class="text-lg font-semibold">Date</span><br>
                                        <span>2024-03-18 10:32:51</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 items-center mt-1">
                                <div class="row">

                                    <div class="col-12  text-end items-center pt-[14px]">
                                        <span class="text-lg font-semibold">Delivery Address</span><br>
                                        <span>222/C, Aloka Uyana Road, Kesbewa</span>
                                    </div>
                                    <div class="col-12  text-end pt-[14px]">
                                        <span class="text-lg font-semibold">Total</span><br>
                                        <span>Rs 5600.00</span>
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
                                            for ($i = 0; $i < 2; $i++) {
                                            ?>
                                                <tr class="border-[#AD1212]">
                                                    <th scope="row">
                                                        <img src="assets/img/drum.jpg" width="20px" height="20px" alt="">
                                                    </th>
                                                    <td>Fender Player Stratocaster Electric Guitar, Arctic White</td>
                                                    <td>Rs 4500.00</td>
                                                    <td class="text-center">2</td>
                                                    <td class="text-center">Rs 300.00</td>
                                                    <td class="text-end">
                                                        Rs 4500.00
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
                                <button class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Update Delivered Status</button>
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
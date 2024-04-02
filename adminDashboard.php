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
    <link rel="stylesheet" type="text/css" href="https://www.prepbootstrap.com/Content/shieldui-lite/dist/css/light/all.min.css" />
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
                                        <p class="text-dark text-4xl fw-semibold">100</p>
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
                                        <p class="text-dark text-4xl fw-semibold">100</p>
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
                                        <p class="text-dark text-4xl fw-semibold">100</p>
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
                                        <p class="text-dark text-4xl fw-semibold">100</p>
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
                                        <h3 class="fw-semibold p-3 text-xl">Earnings</h3>
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

                <!-- manage products -->
                <div class="row mt-4 d-none manage-products">
                    <div class="w-[43%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                        <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Manage Products</span>
                    </div>
                    <div class="w-[43%] bg-white pt-5 ps-5 pe-5 pb-5  text-end">
                        <button class="bg-[#AD1212] text-white p-2 rounded "><i class="bi bi-plus-lg pe-2"></i>Add Product</button>
                    </div>
                    <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                        <div class="row">
                            <table class="table  hover:cursor-pointer">
                                <thead class="bg-red-100 ">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Registered Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <?php
                                    for ($i = 0; $i < 10; $i++) {
                                    ?>
                                        <tr class="border-[#AD1212]">
                                            <th scope="row">
                                                <img src="assets/img/drum.jpg" width="20px" height="20px" alt="">
                                            </th>
                                            <td>Epiphone Les Paul Standard Electric Guitar, Heritage Cherry Sunburst</td>
                                            <td>40000</td>
                                            <td>2024-03-18 10:26:13</td>
                                            <td>
                                                <!-- <div class="bg-[#F7CECE] text-center p-1 rounded hover:cursor-pointer">
                                                    <span class="text-[#E63535]">Deactivate</span>
                                                </div> -->
                                                <div class="bg-[#C9F0DD] text-center p-1 rounded hover:cursor-pointer">
                                                    <span class="text-[#18BA6B]">Activate</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- manage products -->

                <!-- manage users -->
                <div class="row mt-4 d-none manage-users">
                    <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%]">
                        <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Manage Users</span>
                    </div>
                    <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                        <div class="row">
                            <table class="table  hover:cursor-pointer">
                                <thead class="bg-red-100 ">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Registered Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <?php
                                    for ($i = 0; $i < 10; $i++) {
                                    ?>
                                        <tr class="border-[#AD1212]">
                                            <th scope="row">
                                                <img src="assets/img/drum.jpg" width="20px" height="20px" alt="">
                                            </th>
                                            <td>Hiranya Semindi</td>
                                            <td>hiranyagunawardhane@gmail.com</td>
                                            <td>2024-03-18 10:26:13</td>
                                            <td>
                                                <!-- <div class="bg-[#F7CECE] text-center p-1 rounded hover:cursor-pointer">
                                                    <span class="text-[#E63535]">Deactivate</span>
                                                </div> -->
                                                <div class="bg-[#C9F0DD] text-center p-1 rounded hover:cursor-pointer">
                                                    <span class="text-[#18BA6B]">Activate</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- manage users -->

                <!-- orders -->
                <div class="row mt-4 d-none orders">
                    <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%]">
                        <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Orders</span>
                    </div>
                    <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                        <div class="row">
                            <table class="table hover:cursor-pointer">
                                <thead class="bg-red-100 ">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Date Time</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <?php
                                    for ($i = 0; $i < 10; $i++) {
                                    ?>
                                        <tr class="border-[#AD1212]">
                                            <th scope="row">
                                                <img src="assets/img/drum.jpg" width="20px" height="20px" alt="">
                                            </th>
                                            <td>660956141c174</td>
                                            <td>hiranyagunawardhane@gmail.com</td>
                                            <td>2024-03-18 10:26:13</td>
                                            <td>Rs.4500.00</td>
                                            <td>
                                                <!-- <div class="bg-[#F7CECE] text-center p-1 rounded hover:cursor-pointer">
                                                    <span class="text-[#E63535]">Deactivate</span>
                                                </div> -->
                                                <div class="bg-[#C9F0DD] text-center p-1 rounded hover:cursor-pointer">
                                                    <span class="text-[#18BA6B]">Pending</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- orders -->

                <!-- promotions -->
                <div class="row mt-4 promotions d-none">
                    <div class="w-[43%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                        <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Promotions</span>
                    </div>
                    <div class="w-[43%] bg-white pt-5 ps-5 pe-5 pb-5  text-end">
                        <button class="bg-[#AD1212] text-white p-2 rounded "><i class="bi bi-plus-lg pe-2"></i>Add Promotion</button>
                    </div>
                    <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="row">
                                    <?php
                                    for ($x = 0; $x < 10; $x++) {
                                    ?>
                                        <div class="col-lg-4 hover:cursor-pointer col-12 items-center flex justify-center mb-5">
                                            <img src="assets/img/image 15.png" alt="prmo_img" width="400px" height="400px">
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- promotions -->

                <!-- edit promotions -->
                <div class="row mt-4 d-none">
                    <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                        <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Edit Promotion</span>
                    </div>

                    <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="row">

                                    <div class="col-lg-4 col-12  justify-center mb-5">
                                        <img src="assets/img/image 15.png" alt="prmo_img" width="400px" height="400px">
                                        <div class="bg-[#555657] text-center py-[13px] hover:cursor-pointer">
                                            <span class="text-white"><i class="bi bi-upload me-3"></i>Upload Image</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 ms-[60px] ">
                                        <div class="row">
                                            <textarea class="p-3 outline-none border-[1px] border-[#AD1212]" name="" id="" cols="30" rows="18"></textarea>
                                            <div class="mt-3 text-center">
                                                <button class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--edit  promotions -->

                <!-- add promotion -->
                <div class="row mt-4  d-none">
                    <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                        <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Add Promotion</span>
                    </div>

                    <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="row">
                                    <div class="col-lg-4 col-12  justify-center mb-5">
                                        <div class="w-[390px] h-[400px] border">
                                            <img src="assets/img/upload.png" class="" alt="prmo_img">
                                        </div>
                                        <div class="bg-[#555657] w-[390px]   text-center py-[13px] hover:cursor-pointer">
                                            <span class="text-white"><i class="bi bi-upload me-3"></i>Upload Image</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 ms-[60px] ">
                                        <div class="row">
                                            <textarea class="p-3 outline-none border-[1px] border-[#AD1212]" name="" id="" cols="30" rows="18"></textarea>
                                            <div class="mt-3 text-center">
                                                <button class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Add Promotion</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- add promotion -->

                <!-- Add product -->
                <div class="row mt-4  d-none">
                    <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                        <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Add Product</span>
                    </div>

                    <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                        <div class="row">
                            <div class="col-4 justify-center mb-5 ">
                                <img src="assets/img/upload.png" class="border w-[90%]" alt="prmo_img" width="400px" height="400px">
                                <div class="bg-[#555657] w-[90%] text-center py-[13px] hover:cursor-pointer">
                                    <span class="text-white"><i class="bi bi-upload me-3"></i>Upload Image</span>
                                </div>
                            </div>
                            <div class="col-8 ">
                                <div class="row">
                                    <select class="lg:w-[32%] me-[2%] disabled border h-[40%]  focus:outline-none p-3 ">
                                        <option value="0">Select Category</option>
                                        <option disabled>No cities available.</option>
                                    </select>
                                    <select class=" lg:w-[32%]  me-[2%] border h-[40%] p-3 focus:outline-none ">
                                        <option value="0">Select Brand</option>
                                        <option disabled>No districts available.</option>
                                    </select>
                                    <select class="lg:w-[32%]  border h-[40%] p-3  focus:outline-none ">
                                        <option value="0">Select Model</option>
                                        <option disabled>No provinces available.</option>
                                    </select>
                                    <input class="border h-[40%] p-3 mt-4 focus:outline-none mt-3" type="text" placeholder="Title">
                                    <textarea placeholder="Description" class="border p-3 mt-4 focus:outline-none mt-3" name="" id="" cols="30" rows="10"></textarea>
                                    <input class="border w-[49%] me-[1%] h-[40%] p-3 mt-4 focus:outline-none mt-3" type="number" placeholder="Price">
                                    <input class="border w-[49%] ms-[1%] h-[40%] p-3 mt-4 focus:outline-none mt-3" type="number" placeholder="Quantity">
                                    <input class="border w-[49%] me-[1%] h-[40%] p-3 mt-4 focus:outline-none mt-3" type="number" placeholder="Delivery Fee Colombo">
                                    <input class="border w-[49%] ms-[1%] h-[40%] p-3 mt-4 focus:outline-none mt-3" type="number" placeholder="Delivery Fee Out of Colombo">
                                    <div class="mt-3 text-center">
                                        <button class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Add Product</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add product -->

                <!-- update product -->
                <div class="row mt-4 d-none">
                    <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                        <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Edit Product</span>
                    </div>

                    <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                        <div class="row">
                            <div class="col-4 justify-center mb-5 ">
                                <img src="assets/img/drum.jpg" class="border w-[90%]" alt="prmo_img" width="400px" height="400px">
                                <div class="bg-[#555657] w-[90%] text-center py-[13px] hover:cursor-pointer">
                                    <span class="text-white"><i class="bi bi-upload me-3"></i>Upload Image</span>
                                </div>
                            </div>
                            <div class="col-8 ">
                                <div class="row">
                                    <select class="lg:w-[32%] me-[2%] disabled border h-[40%]  focus:outline-none p-3 ">
                                        <option value="0">Select Category</option>
                                        <option disabled>No cities available.</option>
                                    </select>
                                    <select class=" lg:w-[32%]  me-[2%] border h-[40%] p-3 focus:outline-none ">
                                        <option value="0">Select Brand</option>
                                        <option disabled>No districts available.</option>
                                    </select>
                                    <select class="lg:w-[32%]  border h-[40%] p-3  focus:outline-none ">
                                        <option value="0">Select Model</option>
                                        <option disabled>No provinces available.</option>
                                    </select>
                                    <input class="border h-[40%] p-3 mt-4 focus:outline-none mt-3" type="text" placeholder="Title">
                                    <textarea placeholder="Description" class="border p-3 mt-4 focus:outline-none mt-3" name="" id="" cols="30" rows="10"></textarea>
                                    <select class="disabled border mt-4 h-[40%]  focus:outline-none p-3 ">
                                        <option value="0">Select Condition</option>
                                        <option disabled>No cities available.</option>
                                    </select>
                                    <input class="border w-[49%] me-[1%] h-[40%] p-3 mt-4 focus:outline-none mt-3" type="number" placeholder="Price">
                                    <input class="border w-[49%] ms-[1%] h-[40%] p-3 mt-4 focus:outline-none mt-3" type="number" placeholder="Quantity">
                                    <input class="border w-[49%] me-[1%] h-[40%] p-3 mt-4 focus:outline-none mt-3" type="number" placeholder="Delivery Fee Colombo">
                                    <input class="border w-[49%] ms-[1%] h-[40%] p-3 mt-4 focus:outline-none mt-3" type="number" placeholder="Delivery Fee Out of Colombo">
                                    <div class="mt-3 text-center">
                                        <button class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Add Product</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- update product -->

                <!-- single order -->
                <div class="row mt-4 d-none ">
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

                <!-- profile -->
                <div class="row mt-4 d-none">
                    <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                        <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Edit Profile</span>
                    </div>

                    <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                        <div class="row">
                            <div class="w-[25%] ml-[37.5%] justify-center mb-5 ">
                                <img src="assets/img/profile_images/Hiranya_65f6eb3def49b.png" class="border w-[90%]" alt="prmo_img" width="400px" height="400px">
                                <div class="bg-[#555657] w-[90%] text-center py-[13px] hover:cursor-pointer">
                                    <span class="text-white"><i class="bi bi-upload me-3"></i>Upload Image</span>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="row">

                                    <input class="border h-[40%] p-3  focus:outline-none " type="text" placeholder="Name">
                                    <input class="border h-[40%] p-3 mt-4 focus:outline-none " type="text" placeholder="Email">


                                    <div class="mt-3 text-center">
                                        <button class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- profile -->

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
            var data2 = [3, 9, 12, 14, 22, 32, 45, 12, 67, 45, 55, 7];
            var data3 = [23, 19, 11, 134, 242, 352, 435, 22, 637, 445, 555, 57];
            var data4 = [13, 19, 112, 114, 212, 332, 435, 132, 67, 45, 55, 7];

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
            var data1 = [12, 3, 4, 2];
            var data2 = [3, 9, 12, 14];

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
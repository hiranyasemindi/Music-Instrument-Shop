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

            </div>

        </div>
    </div>


    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>
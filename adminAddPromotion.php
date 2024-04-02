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

                <!-- add promotion -->
                <div class="row mt-4 ">
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
            </div>

        </div>
    </div>


    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>

</html>
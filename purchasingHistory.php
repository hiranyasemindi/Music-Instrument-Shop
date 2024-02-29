<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                                    for ($x = 0; $x < 5; $x++) {
                                    ?>
                                        <!-- lg screen -->
                                        <div class="col-10 offset-1  mt-4 d-none d-lg-block">
                                            <div class="row">
                                                <div class="border py-2">
                                                    <p class="text-[#999b9e]">1st September, 2021 at 11.30 PM</p>
                                                </div>
                                                <div class="border">
                                                    <div class="row">
                                                        <?php
                                                        for ($x = 0; $x < 2; $x++) {
                                                        ?>
                                                            <div class="p-4 w-[15%] ">
                                                                <img src="assets/img/drum.jpg" class="border" width="150px" height="100px" alt="">
                                                            </div>
                                                            <div class="w-[40%]  flex items-center px-4">
                                                                <div class="row">
                                                                    <p class="fw-semibold text-xl">Drum Dolgi Drum Dolgi Drum Dolgi</p><br>
                                                                    <p class="mt-4 text-xl">Rs 20, 000.00</p>
                                                                    <p class="text-[#999b9e] mt-2">Condition: BrandNew</p>
                                                                    <p class="mt-2">Delivery Fee: Rs 300.00</p>
                                                                    <!-- <p class="mt-4 fw-semibold text-lg">Total: Rs 20,300.00</p> -->
                                                                </div>
                                                            </div>

                                                            <div class="w-[20%] flex items-center px-4">
                                                                <div class="row">
                                                                    <p class="mt-4 fw-semibold text-lg">Quantity: 5</p>
                                                                </div>
                                                            </div>
                                                            <div class="w-[25%] flex items-center px-4">
                                                                <div class="row">
                                                                    <p class="mt-4 text-[#AD1212]  fw-semibold text-lg">Total: Rs 20,300.00</p>
                                                                </div>
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
                                                for ($x = 0; $x < 2; $x++) {
                                                    ?>
                                                    <div class="border col-12">
                                                    <div class="row">
                                                        <div class=" w-[20%] ml-3 mb-[60px] pb-5 flex items-center">
                                                            <div class="card row">
                                                                <img src="assets/img/drum.jpg" class="px-1 " width="150px" height="150px" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="w-[75%] flex items-start px-4 mt-3">
                                                            <div class="row">
                                                                <p class="fw-semibold text-lg">Drum Dolgi Drum Dolgi Drum Dolgi</p><br>
                                                                <span class=" mt-2 text-lg me-5">Rs 20, 000.00</span>
                                                                <p class="text-[#999b9e] mt-1">Condition: BrandNew</p>
                                                                <p class="mt-1">Delivery Fee: Rs 300.00</p>
                                                                <p class="mt-3 fw-semibold text-md">Quantity: 5</p>
                                                                <p class="my-2  text-[#AD1212]  fw-semibold text-lg">Total: Rs 20,300.00</p>
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
</body>

</html>
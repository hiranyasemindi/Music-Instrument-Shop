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

    <div class="container-fluid mb-5" onload="toggle();">
        <div class="row">

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="row">
                            <div class=" col-8 flex items-center justify-center offset-2 shadow card">
                                <img src="assets/img/drum.jpg" alt="" width="300px" height="300px">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 text-center text-lg-start mt-3 mt-lg-0 col-12 items-center justify-center flex">
                        <div class="row">
                            <h1 class="text-3xl font-semibold">Golden bracelet with Silver color Diamond 22KT</h1>
                            <span class="text-lg mt-4  me-4">Brand: Sony</span>

                            <span class="text-3xl font-medium mt-4 text-[#AD1212]">LKR 50,000.00</span>
                            <div class="d-inline-flex items-center justify-center lg:justify-start lg:items-start text-lg-start ">
                                <span class="text-lg mt-4 text-[#AD1212] me-4">4.9</span>
                                <div class="d-inline-flex items-center justify-center ">
                                    <span class="text-lg me-2 mt-4 text-[#AD1212]"><i class="bi bi-star-fill"></i></span>
                                    <span class="text-lg me-2 mt-4 text-[#AD1212]"><i class="bi bi-star-fill"></i></span>
                                    <span class="text-lg me-2 mt-4 text-[#AD1212]"><i class="bi bi-star-fill"></i></span>
                                    <span class="text-lg me-2 mt-4 text-[#AD1212]"><i class="bi bi-star-fill"></i></span>
                                    <span class="text-lg me-2 mt-4 text-[#AD1212]"><i class="bi bi-star-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-12 flex justify-center align-center align-lg-start justify-lg-start">
                                <div class="bg-[#AD1212] my-2 h-[2px] w-[90%] d-block d-lg-none ml-[2%] rounded"></div>
                            </div>
                            <div class="flex  justify-center align-center  lg:justify-start lg:items-start mt-3 text-lg-start col-12">
                                <span class="fw-semibold text-lg me-1">Availability : </span>
                                <span class="fw-semibold text-lg text-[#1CAA19]"> 5 in stock</span>
                            </div>
                            <div class="flex mt-5">

                                <input type="number" class="text-center outline outline-[0.5px] outline-[#CACACA] me-4" placeholder="0" />

                                <div class="rounded-full me-3 bg-[#fcb3b3] py-[10px] px-[15px]">
                                    <i class="bi bi-heart text-[#AD1212] text-[20px] "></i>
                                </div>
                                <div class="rounded-full bg-[#fcb3b3] py-[10px] px-[15px]">
                                    <i class="bi bi-cart text-[#AD1212] text-[20px] "></i>
                                </div>

                            </div>
                           
                        </div>
                    </div>


                    <p class="text-xl text-center font-semibold mt-4 ps-5 ms-5 text-[#AD1212]">Additional Information</p>
                    <div class="col-lg-10 col-12 offset-0 offset-lg-1 mb-5 text-center" id="additionalInfoArea">
                    <div class="col-12 offset-0  my-5 pe-3" id="descriptionArea">
                                <p class="text-[#908E8E]">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                                    et dolore magna aliqua. Vulputate dignissim suspendisse in est ante in nibh. Scelerisque purus semper
                                    eget duis at. Habitant morbi tristique senectus et netus. Vel pharetra vel turpis nunc eget.
                                    Semper viverra nam libero justo. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque
                                    habitant morbi. Donec adipiscing tristique risus nec feugiat in. Suspendisse potenti nullam ac tortor. At auctor urna nunc id.

                                    Ac turpis egestas integer eget aliquet nibh praesent tristique. Id aliquet lectus proin nibh nisl condimentum id venenatis.
                                    Consectetur lorem donec massa sapien faucibus et. Turpis massa sed elementum tempus. Lorem mollis
                                    aliquam ut porttitor leo a. Convallis posuere morbi leo urna molestie.

                                </p>
                            </div>
                    </div>

                    <div class="p-4 mt-5">
                        <h2 class="text-3xl font-bold">Related Items</h2>
                        <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                        <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                    </div>

                    <div class="col-lg-10 offset-lg-1 col-12">
                        <div class="row">
                            <?php
                            for ($x = 0; $x < 4; $x++) {
                            ?>
                                <div class="col-6 col-lg-3 mt-3">
                                    <div class="row">
                                        <div class="col-10 offset-1 shadow card">
                                            <div class="row d-flex justify-content-end align-items-start">
                                                <div class="col-1 d-flex justify-content-center align-items-center mt-1 mx-2 fw-semibold" style="font-size: 0.8rem; border-radius: 50%; width: 2.5rem; height: 2.5rem; position: absolute; z-index: 2; color: #FFFFFF; background-color: #AD1212;">
                                                    -15%</div>
                                            </div>
                                            <div class="flex items-center justify-center">
                                            <img src="assets/img/drum.jpg" class="image-style" width="200px" height="200px">
                                            </div>
                                            <div class="row product-onclick-view justify-content-center align-content-center " style="position: absolute;" id="hover-view">
                                                <div style="width: 100%;">
                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                                            <p class="text-center" style="color: #FFFFFF; font-size: 0.9rem;">Golden
                                                                bracelet with Silver color Diamond 22KT</p>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center mt-2 mb-2" style="height: 100%;">
                                                            <p class="text-center fw-bold" style="color: #fcb3b3; font-size: 1rem;">
                                                                LKR 50,000</p>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center mt-2 mb-1" style="height: 100%;">
                                                            <span class="col-2 text-center fw-bold" style="color: #AD1212;">4.9</span>
                                                            <span class="col-6"><i class="bi bi-star-fill p-1" style="color: #AD1212;"></i><i class="bi bi-star-fill p-1" style="color: #AD1212;"></i><i class="bi bi-star-fill p-1" style="color: #AD1212;"></i><i class="bi bi-star-fill p-1" style="color: #AD1212;"></i><i class="bi bi-star-fill p-1" style="color: #AD1212;"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="width: 100%;" class="mt-3 text-center  align-items-center">
                                                    <div class="product-dot col-12 ">
                                                        <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                                            <div class="col-2 d-flex justify-content-center align-items-center" style="color: #AD1212; border-radius: 50%; width: 2.5rem; height: 2.5rem; background-color: #fcb3b3;">
                                                                <i class="bi bi-heart fs-5 mt-1"></i>
                                                            </div>
                                                            <div class="col-1"></div>
                                                            <div class="col-2 d-flex justify-content-center align-items-center" style="color: #AD1212; border-radius: 50%; width: 2.5rem; height: 2.5rem; background-color: #fcb3b3;">
                                                                <i class="bi bi-bag fs-5"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <?php include "App/includes/footer.php"; ?>
    <script src="assets/js/script.js"></script>
</body>

</html>
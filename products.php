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

                    <div class="col-lg-3 d-none d-lg-block border ">
                        <div class="row">
                            <div class="w-[90%] ml-[5%]">
                                <div class="row">
                                    <p class="text-2xl p-3 fw-semibold">Filter Products</p>
                                    <p class="ps-4 pt-4 text-lg">Category</p>
                                    <div class="w-[90%] ml-[5%] mt-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < 6; $x++) {
                                            ?>
                                                <div class="w-[32%] hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                    Mobile
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <p class="ps-4 pt-4 text-lg">Brand</p>
                                    <div class="w-[90%] ml-[5%] mt-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < 6; $x++) {
                                            ?>
                                                <div class="w-[32%] hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                    Mobile
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <p class="ps-4 pt-4 text-lg">Model</p>
                                    <div class="w-[90%] ml-[5%] mt-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < 6; $x++) {
                                            ?>
                                                <div class="w-[32%] hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                    Mobile
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <p class="ps-4 pt-4 text-lg">Price</p>
                                    <div class="w-[90%]  ml-[5%]">
                                        <div class="row">
                                            <input type="text" class="me-[2%] border h-[50px] w-[49%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Min">
                                            <input type="text" class="border h-[50px] w-[49%]  p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Max">
                                        </div>
                                    </div>
                                    <p class="ps-4 pt-4 text-lg">Color Family</p>
                                    <div class="w-[90%] ml-[5%] mt-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < 6; $x++) {
                                            ?>
                                                <div class="w-[32%] flex items-center justify-center hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                    <div class="w-[15px] rounded-1  h-[15px] bg-red-200"></div>
                                                    <div class="ms-1 w-[50%]">
                                                        Blue
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <p class="ps-4 pt-4 text-lg">Rating</p>
                                    <div class="w-[90%] ml-[5%] mt-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < 4; $x++) {
                                            ?>
                                                <div class="w-[24%] flex items-center justify-center hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                    <i class="bi bi-star-fill text-yellow-500 font-semibold hover:cursor-pointer "></i>

                                                    <div class="ms-2">
                                                        5
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <p class="ps-4 pt-4 text-lg">Sort Products</p>
                                    <select class="w-[90%] ml-[5%]  border h-[40%]  focus:outline-none p-3 mt-3" id="">
                                        <option>Select Sort Option</option>
                                        <option>Price Law to High</option>
                                        <option>Price Law to High</option>
                                        <option>Price Law to High</option>
                                        <option>Price Law to High</option>
                                    </select>
                                    <div>
                                        <button class="border  w-[45%] ms-[2%] me-[3%] rounded px-5 py-[12px] mt-4 text-[#AD1212] font-bold" style="border-color:#AD1212 ;">Clear</button>
                                        <button class="bg-[#AD1212] w-[45%]  rounded px-5 py-[12px] mt-4 text-white font-bold">Apply</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 text-end p-3 d-block d-lg-none " data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class="bi bi-funnel-fill text-[#AD1212] " ></i><span class="text-[#AD1212] ps-2">Filter</span>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title text-2xl p-3 fw-semibold" id="offcanvasRightLabel">Filter Products</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                            <div class="w-[90%] ml-[5%]">
                                <div class="row">
                                    <p class=" pt-4 text-start text-lg">Category</p>
                                    <div class="w-[90%] ml-[5%] mt-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < 6; $x++) {
                                            ?>
                                                <div class="w-[32%] hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                    Mobile
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <p class="pt-4 text-start text-lg">Brand</p>
                                    <div class="w-[90%] ml-[5%] mt-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < 6; $x++) {
                                            ?>
                                                <div class="w-[32%] hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                    Mobile
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <p class="pt-4 text-start text-lg">Model</p>
                                    <div class="w-[90%] ml-[5%] mt-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < 6; $x++) {
                                            ?>
                                                <div class="w-[32%] hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                    Mobile
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <p class="pt-4 text-start text-lg">Price</p>
                                    <div class="w-[90%]  ml-[5%]">
                                        <div class="row">
                                            <input type="text" class="me-[2%] border h-[50px] w-[49%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Min">
                                            <input type="text" class="border h-[50px] w-[49%]  p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Max">
                                        </div>
                                    </div>
                                    <p class="pt-4 text-start text-lg">Color Family</p>
                                    <div class="w-[90%] ml-[5%] mt-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < 6; $x++) {
                                            ?>
                                                <div class="w-[32%] flex items-center justify-center hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                    <div class="w-[15px] rounded-1  h-[15px] bg-red-200"></div>
                                                    <div class="ms-1 w-[50%]">
                                                        Blue
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <p class="pt-4 text-start text-lg">Rating</p>
                                    <div class="w-[90%] ml-[5%] mt-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < 4; $x++) {
                                            ?>
                                                <div class="w-[24%] flex items-center justify-center hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                    <i class="bi bi-star-fill text-yellow-500 font-semibold hover:cursor-pointer "></i>

                                                    <div class="ms-2">
                                                        5
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <p class="pt-4 text-start text-lg">Sort Products</p>
                                    <select class="w-[90%] ml-[5%]  border h-[40%]  focus:outline-none p-3 mt-3" id="">
                                        <option>Select Sort Option</option>
                                        <option>Price Law to High</option>
                                        <option>Price Law to High</option>
                                        <option>Price Law to High</option>
                                        <option>Price Law to High</option>
                                    </select>
                                    <div>
                                        <button class="border  w-[48%]  me-[3%] rounded px-5 py-[12px] mt-4 text-[#AD1212] font-bold" style="border-color:#AD1212 ;">Clear</button>
                                        <button class="bg-[#AD1212] w-[45%]  rounded px-5 py-[12px] mt-4 text-white font-bold">Apply</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-12   ">
                        <div class="row">
                            <?php
                            for ($x = 0; $x < 15; $x++) {
                            ?>
                                <div class="col-6 col-lg-3 mt-2">
                                    <div class="row">
                                        <div class="col-10 offset-1 mb-4 shadow card">
                                            <div class="row d-flex justify-content-end align-items-start">
                                                <div class="col-1 d-flex justify-content-center align-items-center mt-1 mx-2 fw-semibold" style="font-size: 0.8rem; border-radius: 50%; width: 2.5rem; height: 2.5rem; position: absolute; z-index: 2; color: #FFFFFF; background-color: #AD1212;">
                                                    -15%</div>
                                            </div>
                                            <div class="flex items-center justify-center">
                                                <img src="assets/img/drum.jpg" alt="" width="200px" height="200px">
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

                                                        <div class="d-flex  justify-content-center mt-2 mb-1" style="height: 100%;">
                                                            <span class="col-4 text-center text-[12px] fw-bold" style="color: #AD1212;">4.9</span>
                                                            <span class="col-8 text-[12px]"><i class="bi bi-star-fill " style="color: #AD1212;"></i><i class="bi bi-star-fill ps-1" style="color: #AD1212;"></i><i class="bi bi-star-fill ps-1" style="color: #AD1212;"></i><i class="bi bi-star-fill ps-1" style="color: #AD1212;"></i><i class="bi bi-star-fill ps-1" style="color: #AD1212;"></i></span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="width: 100%;" class="mt-lg-3 mt-1 text-center  align-items-center">
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
    <script src="assets/plugin/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>
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

                    <div class="p-4 mt-4 pt-5">
                        <h2 class="text-3xl font-bold">About Us</h2>
                        <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                        <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-7 col-12 ms-lg-4 ms-0 flex justify-end">
                                <img src="assets/img/image 21.png" alt="" width="800px" height="600px">
                            </div>
                            <div class="col-lg-4 col-12 ms-lg-3 ms-0">
                                <img src="assets/img/image 22.png"  class="mt-4 mt-lg-0 pt-3 pt-lg-0" alt="" width="400px" height="300px">
                                <img src="assets/img/image 23.png" class="mt-4 pt-3" width="400px" height="300px">
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <p class="pt-3 mt-4 text-center font-semibold text-3xl">Who We Are</p>
                            <p class="text-lg p-5 text-[#999b9e]">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="bg-white col-lg-4 col-12 flex items-center justify-center p-3 w-[500px] ">
                                <p class="text-[#AD1212] text-center font-semibold text-2xl"> Organization Vision & Mission</p>
                            </div>
                            <div class="col-lg-8 col-12">
                                <img src="assets/img/image 24.png" alt="" height="200px">
                            </div>

                            <p class="text-center mt-5 font-semibold text-xl">Vision</p>
                            <p class="text-lg px-5 mt-3 text-[#999b9e]">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id est laborum.</p>

                            <p class="text-center mt-5 font-semibold text-xl">Mission</p>
                            <p class="text-lg px-5 mt-3 text-[#999b9e]">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <p class="text-center mt-5 pt-5  font-semibold text-3xl">Our Management</p>
                            <div class="col-10 offset-1">
                                <div class="row">
                                    <?php
                                    for ($x = 0; $x < 4; $x++) {
                                    ?>
                                        <div class="col-lg-3 col-12 mt-5">
                                            <div class="row flex items-center justify-center">
                                                <div class="w-[160px] h-[160px] col-12 rounded-circle bg-cover" style="background-image: url('assets/img/round_profil_picture_before_.webp');">
                                                </div>
                                                <p class="text-center mt-2 font-semibold">Robert Fox</p>
                                                <p class="text-center text-[#999b9e]">Director</p>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <p class="text-center mt-5 pt-5 font-semibold text-3xl">History of Us</p>
                            <p class="text-lg px-5 mt-3 text-[#999b9e]">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id est laborum.</p>
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
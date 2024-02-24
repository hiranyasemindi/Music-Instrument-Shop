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

            <div class="col-12 bg-cover mt-3 mt-lg-0 bg-center bg-no-repeat h-[35rem] items-center flex" style="background-image: url('assets/img/acoustic-guitar-snare-drum-black-background-isolated.jpg')">
                <!-- <img src="logo/logoo.png" alt="logo" width="400px" height="400px" class="d-none d-lg-block"> -->
            </div>

            <div class="col-12">
                <div class="row">

                    <div class="p-4">
                        <h2 class="text-3xl font-bold">Trending Categories</h2>
                        <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                        <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                    </div>

                    <?php include "App/includes/topCategories.php"; ?>

                    <div class="p-4 mt-5">
                        <h2 class="text-3xl font-bold">Last Arrivals</h2>
                        <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                        <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                    </div>

                    <?php include "App/includes/latestProducts.php"; ?>

                    <div class="col-10 offset-1 mt-5">
                        <div class="row mt-5">
                            <div class="col-lg-7 col-12 ">
                                <img src="assets/img/acoustic-guitar-drums-keys-black-background.jpg" alt="" width="700px" height="700px">
                            </div>
                            <div class="col-lg-5 py-3 col-12 items-center justify-center mt-3 mt-lg-0">
                                <h2 class="text-3xl font-bold">Best Edition</h2>
                                <div class="bg-[#AD1212] my-3 h-1 w-[80%] ml-[2%] rounded"></div>

                                <p class="text-lg py-4 text-[#999b9e]">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                    ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                    in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                    officia deserunt mollit anim id est laborum.</p>
                                <button class="bg-[#AD1212] mt-4 rounded px-5 py-3 text-white font-bold">View More</button>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 mt-5 pt-5">
                        <h2 class="text-3xl font-bold">Customer Reviews</h2>
                        <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                        <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                    </div>
                    
                    <?php include "App/includes/customerRreviews.php"; ?>

                </div>
            </div>

        </div>
    </div>

    <?php include "App/includes/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Set scroll amount
            var scrollAmount = 200; // Adjust as needed

            // Previous button click handler
            $("#previousButton").click(function() {
                $("#cardContainer").animate({
                    scrollLeft: "-=" + scrollAmount
                }, "slow");
            });

            // Next button click handler
            $("#nextButton").click(function() {
                $("#cardContainer").animate({
                    scrollLeft: "+=" + scrollAmount
                }, "slow");
            });
        });
    </script>
</body>

</html>
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

    <?php include "App/includes/header.php";
    class wishListTemplete
    {
        public static function generate($wishlistItems, $district)
        {
    ?>

            <div class="container-fluid mb-5">
                <div class="row">

                    <div class="col-12">
                        <div class="row">

                            <div class="p-4 mt-4 pt-lg--5">
                                <h2 class="text-3xl ps-4 font-bold">Wishlist</h2>
                                <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                                <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                            </div>

                            <div class="col-12  ">
                                <div class="row">
                                    <div class=" col-12">
                                        <div class="row">
                                            <p id="spumail" class="d-none"><?php echo $_SESSION["user"]["email"]; ?></p>
                                            <input type="text" value="1" class="d-none" id="requiredQty">
                                            <?php

                                            while ($product = $wishlistItems->fetch_assoc()) {
                                            ?>
                                                <!-- lg screen -->
                                                <div class="col-12 mt-4 d-none d-lg-block">
                                                    <div class="row px-5">

                                                        <div class=" w-[30%] card flex items-center">
                                                            <img id="product-image" src="<?php echo $product["image_path"]; ?>" class="px-1 " width="150px" height="150px" alt="">
                                                        </div>
                                                        <div class="w-[40%] flex items-start px-4">
                                                            <div class="row">
                                                                <p id="title" class="fw-semibold text-2xl"><?php echo $product["title"]; ?></p><br>
                                                                <p class="text-[#AD1212] mt-4 text-xl">Rs <span id="price"><?php echo $product["price"]; ?></span>.00</p>
                                                                <p class="text-[#999b9e] mt-2">Condition: <?php echo $product["condition"]; ?></p>
                                                                <?php $df = $district == "Colombo" ?  $product["delivery_fee_colombo"] : $product["delivery_fee_other"]; ?>
                                                                <p class="mt-2">Delivery Fee: Rs <?php echo $df; ?>.00</p>
                                                                <button onclick="buyNow(<?php echo $product['id']; ?>,'<?php echo addslashes($product['condition']); ?>', <?php echo $df; ?>, <?php echo $product['qty']; ?>);" class="bg-[#AD1212] col-5 ms-2 rounded px-5 py-[12px] mt-4 text-white font-bold">Buy Now</button>
                                                            </div>
                                                        </div>
                                                        <div class="w-[30%]">
                                                            <div class="flex items-end justify-end">
                                                                <i onclick="addToCart(<?php echo $product['product_id']; ?>);" class="bi bi-cart font-semibold mx-2 hover:cursor-pointer text-[22px]"></i>
                                                                <i onclick="deleteFromWishlist(<?php echo $product['product_id']; ?>);" class="bi bi-trash3 font-semibold mx-2 text-[22px] hover:cursor-pointer text-[#ed2835]"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- lg screen -->

                                                <!--sm screen  -->
                                                <div class="col-12 d-block d-lg-none">
                                                    <div class="row">

                                                        <div class=" w-[20%] ml-3 mb-[90px] pb-5 flex items-center">
                                                            <div class="card row">
                                                                <img id="product-image" src="<?php echo $product["image_path"]; ?>" class="px-1 " width="150px" height="150px" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="w-[75%] flex items-start px-4 mt-3">
                                                            <div class="row">
                                                                <p id="title" class="fw-semibold text-xl"><?php echo $product["title"]; ?></p><br>

                                                                <div class="my-2">

                                                                    <div class="flex items-center justify-center ">
                                                                        <span class="text-[#AD1212] mt-2 text-lg me-5">Rs<span id="price"> <?php echo $product["price"]; ?></span>.00</span>
                                                                        <i onclick="addToCart(<?php echo $product['product_id']; ?>);" class="bi bi-cart hover:cursor-pointer font-semibold me-2 text-[20px]"></i>
                                                                        <i onclick="deleteFromWishlist(<?php echo $product['product_id']; ?>);" class="bi bi-trash3 hover:cursor-pointer font-semibold mx-2 text-[20px] text-[#ed2835]"></i>
                                                                    </div>

                                                                </div>
                                                                <p class="text-[#999b9e] mt-1">Condition: <?php echo $product["condition"]; ?></p>
                                                                <?php $df = $district == "Colombo" ?  $product["delivery_fee_colombo"] : $product["delivery_fee_other"]; ?>
                                                                <p class="mt-1">Delivery Fee: Rs <?php echo  $df; ?>.00</p>

                                                                <button onclick="buyNow(<?php echo $product['id']; ?>,'<?php echo addslashes($product['condition']); ?>', <?php echo $df; ?>, <?php echo $product['qty']; ?>);" class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold">Buy Now</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--sm screen  -->
                                                <hr class="mt-4">
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

        <?php
        }

        public static function emptyWishlist()
        {
        ?>
            <div class="flex items-center justify-center">
                <img src="assets/img/undraw_no_data_re_kwbl.svg" alt="emptyWishlist_img" width="500px" height="500px">
            </div>
            <div class="flex items-center justify-center mt-4">
                <span class="fw-semibold text-3xl">Your Wishlist is Empty</span>
            </div>
            <div class="flex items-center justify-center mt-4">
                <button onclick="window.location.href = 'index.php'" class="bg-[#AD1212] rounded px-5 py-[12px] mt-1 my-5 text-white font-bold">Go to Shopping</button>
            </div>
    <?php
        }
    }
    ?>


    <script src="assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>
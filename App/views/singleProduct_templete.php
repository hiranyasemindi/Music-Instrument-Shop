<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Product | SONORITY</title>
    <link rel="icon" href="logo//logoo.png">
    <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <?php

    class SignleProductTemplete
    {
        public static function generate($product, $relatedItems, $address)
        {
            include "App/includes/header.php";
    ?>
            <div class="container-fluid mb-5"">
            <div class=" row">

                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="row">
                                <div class=" col-8 flex items-center justify-center offset-2 shadow card">
                                    <img src="<?php echo $product["image_path"]; ?>" id="product-image" alt="" width="300px" height="300px">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 text-center text-lg-start mt-3 mt-lg-0 col-12 items-center justify-center flex">
                            <div class="row">
                                <h1 class="text-3xl font-semibold"><?php echo $product["title"]; ?></h1>
                                <span class="text-lg mt-4  me-4">Brand: <?php echo $product["brand_name"]; ?></span>

                                <span class="text-3xl font-medium mt-4 text-[#AD1212]">LKR <?php echo $product["price"]; ?>.00</span>
                                <div class="d-inline-flex items-center justify-center lg:justify-start lg:items-start text-lg-start ">
                                    <span class="text-lg mt-4 text-[#AD1212] me-4"><?php echo $product["rating"]; ?>.0</span>

                                    <div class="d-inline-flex items-center justify-center ">
                                        <?php
                                        $fill = $product["rating"];
                                        for ($x = 0; $x < 5; $x++) {
                                            $starClass = ($x < $fill) ? "bi bi-star-fill" : "bi bi-star";
                                        ?>
                                            <span class="text-lg me-2 mt-4 text-[#AD1212]"><i class="<?php echo $starClass; ?> p-1" style="color: #AD1212;"></i></span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-12 flex justify-center align-center align-lg-start justify-lg-start">
                                    <div class="bg-[#AD1212] my-2 h-[2px] w-[90%] d-block d-lg-none ml-[2%] rounded"></div>
                                </div>
                                <div class="flex  justify-center align-center  lg:justify-start lg:items-start mt-3 text-lg-start col-12">
                                    <span class="fw-semibold text-lg me-1">Availability : </span>
                                    <span class="fw-semibold text-lg text-[#1CAA19]"> <?php echo $product["qty"]; ?> in stock</span>
                                </div>
                                <div class="flex mt-5">

                                    <input onkeyup="checkQty(<?php echo $product['qty']; ?>, event);" id="requiredQty" type="number" class="text-center outline outline-[0.5px] outline-[#CACACA] me-4" placeholder="0" />

                                    <div onclick="addToWishlist(<?php echo $product['id']; ?>);" class="rounded-full hover:cursor-pointer me-3 bg-[#fcb3b3] py-[10px] px-[15px]">
                                        <i class="bi bi-heart text-[#AD1212] text-[20px] "></i>
                                    </div>
                                    <div onclick="addToCart(<?php echo $product['id']; ?>);" class="rounded-full hover:cursor-pointer bg-[#fcb3b3] py-[10px] px-[15px]">
                                        <i class="bi bi-cart text-[#AD1212] text-[20px] "></i>
                                    </div>

                                </div>
                                <p id="spumail" class="d-none"><?php echo $_SESSION["user"]["email"]; ?></p>
                                <div>
                                    <?php
                                    if ($address) {
                                        $df = $address["district_name"] == "Colombo" ? $product['delivery_fee_colombo'] : $product['delivery_fee_other'];

                                    ?>
                                        <button type="submit" id="payhere-payment" onclick="buyNow(<?php echo $product['id']; ?>,'<?php echo addslashes($product['condition']); ?>', <?php echo $df; ?>, <?php echo $product['qty']; ?>);" class="bg-[#AD1212] hover:cursor-pointer mt-4 rounded px-2 py-3 w-[34%] text-white font-bold" style="background-color: #AD1212;">Buy Now</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="bg-[#AD1212] mt-4 rounded px-2 py-3 w-[34%] text-white font-bold hover:cursor-pointer" onclick="window.location.href = 'profile.php'">Update your profile to Buy Product</button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <p class="text-xl text-center font-semibold mt-4 ps-5 text-[#AD1212]">Additional Information</p>
                        <div class="col-lg-10 col-12 offset-0 offset-lg-1 mb-5 text-center" id="additionalInfoArea">
                            <div class="col-12 offset-0  my-5 pe-3" id="descriptionArea">
                                <p class="text-[#908E8E]"><?php echo $product["description"]; ?> </p>
                            </div>
                        </div>

                        <?php
                        RelatedItemsTemplete::generate($relatedItems);
                        ?>

                    </div>
                </div>

            </div>
            </div>
            <?php include "App/includes/footer.php"; ?>
    <?php
        }
    }
    ?>

    <?php
    class RelatedItemsTemplete
    {
        public static function generate($relatedItems)
        {
    ?>
            <div class="p-4 mt-5">
                <h2 class="text-3xl font-bold">Related Items</h2>
                <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
            </div>

            <div class="col-lg-10 offset-lg-1 col-12">
                <div class="row">
                    <?php
                    while ($item = $relatedItems->fetch_assoc()) {
                    ?>
                        <div class="col-6 col-lg-3 mt-3">
                            <div class="row">
                                <div class="col-10 offset-1 shadow card">

                                    <div class="flex items-center justify-center">
                                        <img src="<?php echo $item["image_path"]; ?>" id="product-image" alt="product_img" width="200px" height="200px">
                                    </div>

                                    <div class="row product-onclick-view justify-content-center align-content-center " style="position: absolute;" id="hover-view">
                                        <div style="width: 100%;">
                                            <div class="col-12">
                                                <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                                    <p id="title" class="text-center text-xl" style="color: #FFFFFF; "><?php echo $item["title"]; ?></p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center mt-2 mb-2" style="height: 100%;">
                                                    <p class="text-center fw-bold text-2xl" style="color: #fcb3b3;">Rs. <span id="price"><?php echo $item["price"]; ?></span>.00</p>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-center mt-2 mb-1" style="height: 100%;">
                                                    <span class="col-2 text-lg-center fw-bold" style="color: #AD1212;"><?php echo $item["rating"]; ?>.0</span>

                                                    <span class="col-7">
                                                        <?php
                                                        $fill = $item["rating"];
                                                        for ($x = 0; $x < 5; $x++) {
                                                            $starClass = ($x < $fill) ? "bi bi-star-fill" : "bi bi-star";
                                                        ?>
                                                            <i class="<?php echo $starClass; ?> p-1" style="color: #AD1212;"></i>
                                                        <?php
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="width: 100%;" class="mt-3 text-center  align-items-center">
                                            <div class="product-dot col-12 ">
                                                <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                                    <div onclick="window.location.href = 'singleProductView.php?id=<?php echo $item['id']; ?>'" class="col-2 d-flex justify-content-center align-items-center" style="color: #AD1212; border-radius: 50%; width: 2.5rem; height: 2.5rem; background-color: #fcb3b3;">
                                                        <i class="bi bi-eye fs-5 mt-1"></i>
                                                    </div>
                                                    <div class="col-1"></div>
                                                    <div onclick="addToWishlist(<?php echo $item['id']; ?>);" class="col-2 d-flex justify-content-center align-items-center" style="color: #AD1212; border-radius: 50%; width: 2.5rem; height: 2.5rem; background-color: #fcb3b3;">
                                                        <i class="bi bi-heart fs-5 mt-1"></i>
                                                    </div>
                                                    <div class="col-1"></div>
                                                    <div onclick="addToCart(<?php echo $item['id']; ?>);" class="col-2 d-flex justify-content-center align-items-center" style="color: #AD1212; border-radius: 50%; width: 2.5rem; height: 2.5rem; background-color: #fcb3b3;">
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
    <?php
        }
    }
    ?>

    <script src="assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>
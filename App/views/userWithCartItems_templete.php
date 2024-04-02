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
    class cartTemplete
    {

        public static function generate($cartItems, $district)
        {

    ?>
            <div class="container-fluid mb-5">
                <div class="row">

                    <div class="col-12">
                        <div class="row">

                            <div class="p-4 mt-4 pt-lg--5">
                                <h2 class="text-3xl ps-4 font-bold">Cart</h2>
                                <div class="bg-[#AD1212] my-3 h-1 w-[10%] d-none d-lg-block ml-[2%] rounded"></div>
                                <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                            </div>

                            <div class="col-12  ">
                                <div class="row">
                                    <p id="umail" class="d-none"><?php echo $_SESSION["user"]["email"]; ?></p>
                                    <div class="col-lg-8 col-12">
                                        <div class="row">
                                            <?php
                                            while ($product = $cartItems->fetch_assoc()) {
                                            ?>
                                                <!-- lg screen -->
                                                <div class="col-12 mt-4 d-none d-lg-block product" data-product-id="<?php echo $product['product_id']; ?>">
                                                    <div class="row ">
                                                        <p class="d-none  product-available"><?php echo $product['product_qty']; ?></p>
                                                        <div class="flex items-center justify-end w-[5%] mt-3 mt-lg-0 ">
                                                            <input onchange="updateCartSummary(<?php echo $product['id']; ?>);" class="cyberpunk-checkbox" type="checkbox" name="" id="cartCheck<?php echo $product['id']; ?>">
                                                        </div>
                                                        <div class=" w-[25%] card flex items-center">
                                                            <img src="<?php echo $product["image_path"]; ?>" class="px-1 product-image" width="150px" height="150px" alt="">
                                                        </div>
                                                        <div class="w-[40%] flex items-start px-4">
                                                            <div class="row">
                                                                <p class="fw-semibold text-2xl product-title"><?php echo $product["title"]; ?></p><br>
                                                                <p class="text-[#AD1212] mt-4 text-xl ">Rs <span class="product-price" id="price<?php echo $product['id']; ?>"><?php echo $product["price"]; ?></span>.00</p>
                                                                <p class="text-[#999b9e] mt-2 product-condition">Condition: <?php echo $product["condition"]; ?></p>
                                                                <p class="mt-2">Delivery Fee: Rs <span class="delivery-price" id="df<?php echo $product['id']; ?>"><?php echo $district == "Colombo" ?  $product["delivery_fee_colombo"] : $product["delivery_fee_other"]; ?></span>.00</p>
                                                            </div>
                                                        </div>
                                                        <div class="w-[30%]">
                                                            <div class="flex items-end justify-end">
                                                                <i onclick="addToWishlist(<?php echo $product['product_id']; ?>);" class="bi bi-heart hover:cursor-pointer font-semibold mx-2 text-[22px]"></i>
                                                                <i onclick="deleteFromCart(<?php echo $product['product_id']; ?>);" class="bi bi-trash3 hover:cursor-pointer font-semibold mx-2 text-[22px] text-[#ed2835]"></i>
                                                            </div>
                                                            <div class="flex justify-end mt-4 ">
                                                                <i onclick="decrementQty(<?php echo $product['id']; ?>, <?php echo $product['price']; ?>);" class="bi bi-dash hover:cursor-pointer font-semibold bg-[#e6e9eb] rounded-circle px-1 me-3 text-[22px]"></i>
                                                                <span class="flex items-center product-quantity" id="qty<?php echo $product['id']; ?>"><?php echo $product["cart_qty"]; ?></span>
                                                                <i onclick="incrementQty(<?php echo $product['product_qty']; ?> , <?php echo $product['id']; ?>, <?php echo $product['price']; ?>);" class="bi bi-plus hover:cursor-pointer font-semibold mx-2 bg-[#e6e9eb] rounded-circle px-1 ms-3 text-[22px]"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- lg screen -->

                                                <!--sm screen  -->
                                                <div class="col-12 d-block d-lg-none">
                                                    <div class="row ">
                                                        <p class="d-none  product-available"><?php echo $product['product_qty']; ?></p>
                                                        <div class="w-[5%] mt-4 ">
                                                            <input onchange="updateCartSummary(<?php echo $product['id']; ?>);" class="cyberpunk-checkbox" type="checkbox" name="" id="cartCheck<?php echo $product['id']; ?>">
                                                        </div>
                                                        <div class=" w-[20%] ml-3 mb-4 pb-5 flex items-center">
                                                            <div class="card row">
                                                                <img src="<?php echo $product["image_path"]; ?>" class="px-1 " width="150px" height="150px" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="w-[65%] flex items-start px-4 mt-3">
                                                            <div class="row">
                                                                <p class="fw-semibold text-xl"><?php echo $product["title"]; ?></p><br>
                                                                <p class="text-[#AD1212] mt-4 text-xl">Rs <span id="price<?php echo $product['id']; ?>"><?php echo $product["price"]; ?></span>.00</p>
                                                                <div class="my-2">
                                                                    <div class="flex justify-end">
                                                                        <i onclick="decrementQty(<?php echo $product['id']; ?>, <?php echo $product['price']; ?>);" class="bi bi-dash hover:cursor-pointer font-semibold bg-[#e6e9eb] rounded-circle px-1 me-3 text-[22px]"></i>
                                                                        <span class="flex items-center" id="qty<?php echo $product['id']; ?>"><?php echo $product["cart_qty"]; ?></span>
                                                                        <i onclick="incrementQty(<?php echo $product['product_qty']; ?> , <?php echo $product['id']; ?>, <?php echo $product['price']; ?>);" class="bi bi-plus hover:cursor-pointer font-semibold mx-2 bg-[#e6e9eb] rounded-circle px-1 ms-3 text-[22px]"></i>
                                                                    </div>
                                                                    <i onclick="addToWishlist(<?php echo $product['product_id']; ?>);" class="bi bi-heart hover:cursor-pointer font-semibold mx-2 text-[22px]"></i>
                                                                    <i onclick="deleteFromCart(<?php echo $product['product_id']; ?>);" class="bi bi-trash3 hover:cursor-pointer font-semibold mx-2 text-[22px] text-[#ed2835]"></i>
                                                                </div>
                                                                <p class="text-[#999b9e] mt-2">Condition: <?php echo $product["condition"]; ?></p>
                                                                <p class="mt-2">Delivery Fee: Rs <span id="df<?php echo $product['id']; ?>"><?php echo $district == "Colombo" ?  $product["delivery_fee_colombo"] : $product["delivery_fee_other"]; ?></span>.00</p>
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
                                    <div class="w-[500px] lg:ml-[20px] mt-2 mt-lg-0 border h-[320px] p-4">
                                        <div class="row">
                                            <div class="col-6 ">
                                                <div class="row">
                                                    <p class="fw-semibold text-3xl">Summary</p>
                                                    <div class="flex-row py-2 mt-2">
                                                        <span class="text-center ">Items</span>
                                                    </div>
                                                    <div class="flex-row  py-2">
                                                        <label class=" text-start">Subtotal</label>
                                                    </div>
                                                    <div class="flex-row py-2"">
                                                <span>Shipping</span>
                                            </div>
                                            <div class=" flex-row py-2"">
                                                        <span class="fw-semibold">Total</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 ">
                                                <div class="row">
                                                    <p class="fw-semibold text-3xl text-white">.</p>
                                                    <div class="flex-row text-end mt-2 py-2">
                                                        <span id="items" class="text-end">0</span>
                                                    </div>
                                                    <div class="flex-row text-end py-2">
                                                        <span class=" text-end">Rs.<span id="subtotal">0</span>.00</span>
                                                    </div>
                                                    <div class="flex-row text-end py-2">
                                                        <span class=" text-end">Rs.<span id="shipping">0</span>.00</span>
                                                    </div>
                                                    <div class="flex-row text-end py-2">
                                                        <span class=" fw-semibold">Rs.<span id="total">00</span>.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button onclick="checkout();" class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold">Checkout</button>

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

        public static function emptyCart()
        {
        ?>
            <div class="flex items-center justify-center">
                <img src="assets/img/undraw_empty_cart_co35.svg" alt="emptyCart_img" width="500px" height="500px">
            </div>
            <div class="flex items-center justify-center mt-4">
                <span class="fw-semibold text-3xl">Your Cart is Empty</span>
            </div>
            <div class="flex items-center justify-center mt-4">
                <button onclick="window.location.href = 'index'" class="bg-[#AD1212] rounded px-5 py-[12px] mt-1 my-5 text-white font-bold">Go to Shopping</button>
            </div>
    <?php
        }
    }
    ?>


    <script src="assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
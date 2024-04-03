<?php
require_once "libs/connection.php";
// include "../checkout.php";
$process = new Process();
$process->handleRequest();
class Process
{

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->handleGETRequest();
        } else {
            include "404.php";
        }
    }

    private function handleGETRequest()
    {
        if (isset($_GET["email"]) && isset($_GET["array"])) {
            $email = $_GET['email'];
            $productArrayJSON = $_GET['array'];
            $productArray = json_decode(urldecode($productArrayJSON), true);
            $this->checkUser($email, $productArray);
        } else {
            include "404.php";
        }
    }

    private function checkUser($email, $array)
    {
        $user = $this->getUserByEmail($email);
        if ($user) {
            $this->loggedUser($array, $email, $user);
        } else {
            include "404.php";
        }
    }

    private function loggedUser($productArray, $email, $user)
    {
        $address = $this->getUserAddress($email);
        if ($address) {
            CheckoutTemplete::generate($address, $productArray);
        } else {
            echo "Update your profile to continue";
        }
    }

    private function getUserByEmail($email)
    {
        $result = $this->search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getUserAddress($email)
    {
        $result = $this->search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `city`.`id`=`user_has_address`.`city_id` 
        INNER JOIN `district` ON `district`.`id`=`city`.`district_id` WHERE `user_email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function search($q)
    {
        return Database::search($q);
    }
}

?>



<?php
class CheckoutTemplete
{
    public static function generate($address, $productArray)
    {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Checkout | SONORITY</title>
            <link rel="icon" href="logo//logoo.png">
            <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        </head>

        <body>
            <?php include "App/includes/header.php"; ?>
            <div class="container-fluid mb-5" id="checkoutArea">
                <div class="row">

                    <div class="col-12">
                        <div class="row">

                            <div class="p-4 mt-lg-4 pt-5">
                                <h2 class="text-3xl font-bold">Checkout</h2>
                                <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                                <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                            </div>


                            <div class="lg:w-[90%]  lg:ml-[5%]">
                                <div class="row">
                                    <div class="col-lg-7 col-12 lg:border px-lg-5 px-3 pb-5">
                                        <div class="row">
                                            <p class="py-3 font-semibold text-xl">Delivery Details</p>
                                            <div class=" border p-3">
                                                <div class="row">
                                                    <div class="col-lg-2 col-5 offset-lg-2 d-block d-lg-none mb-3 mt-lg-0 text-center hover:cursor-pointer">
                                                        <p class="bg-[#e6e9eb] rounded-5 p-1">Change</p>
                                                    </div>
                                                    <div class="col-lg-8 col-12">
                                                        <p><?php echo $address["line1"] . " " . $address["line2"] ?></p>
                                                        <p><?php echo $address["district_name"] ?></p>
                                                        <p><?php echo $address["postal_code"] ?></p>
                                                    </div>
                                                    <!-- <div class="col-lg-2 d-none d-lg-block col-5 offset-lg-2 mt-2 mt-lg-0 text-center hover:cursor-pointer">
                                                        <p class="bg-[#e6e9eb] rounded-5 p-1">Change</p>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <p class="py-3 font-semibold text-xl">Items</p>
                                            <div class="border">
                                                <div class="row">
                                                    <?php
                                                    $items = count($productArray);
                                                    $subtotal = 0;
                                                    $shipping = 0;
                                                    $title = "";
                                                    foreach ($productArray as $product) {
                                                        $subtotal += $product["price"];
                                                        $shipping += $product["delivery_fee"];
                                                        $title = $product["title"] . ",";
                                                    ?>

                                                        <!-- lg screen -->
                                                        <div class="col-12 my-4 d-none d-lg-block ">
                                                            <div class="row ">
                                                                <div class="ml-[20px] w-[25%] card flex items-center">
                                                                    <img src="<?php echo $product["image"]; ?>" class="px-1 " width="150px" height="150px" alt="">
                                                                </div>
                                                                <div class="w-[40%] flex items-start px-4">
                                                                    <div class="row">
                                                                        <p class="fw-semibold text-lg"><?php echo $product["title"]; ?></p><br>
                                                                        <p class="text-[#AD1212] mt-4 text-xl">Rs <?php echo $product["price"]; ?>.00</p>
                                                                        <p class="text-[#999b9e] mt-2"><?php echo $product["condition"]; ?></p>
                                                                        <p class="mt-2">Delivery Fee: Rs <?php echo $product["delivery_fee"]; ?>.00</p>
                                                                    </div>
                                                                </div>
                                                                <div class="w-[30%]">
                                                                    <div class="flex items-end justify-end">
                                                                        <i onclick="addToWishlist(<?php echo $product['id']; ?>);" class="bi bi-heart hover:cursor-pointer font-semibold mx-2 text-[22px]"></i>
                                                                        <!-- <i class="bi bi-trash3 hover:cursor-pointer font-semibold mx-2 text-[22px] text-[#ed2835]"></i> -->
                                                                    </div>
                                                                    <div class="flex justify-end mt-4 ">
                                                                        <!-- <i class="bi bi-dash font-semibold bg-[#e6e9eb] rounded-circle px-1 me-3 text-[22px]"></i> -->
                                                                        <span class="flex items-center pe-2">Qty: </span>
                                                                        <span class="flex items-center fw-semibold"><?php echo $product["quantity"]; ?></span>
                                                                        <!-- <i class="bi bi-plus font-semibold mx-2 bg-[#e6e9eb] rounded-circle px-1 ms-3 text-[22px]"></i> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- lg screen -->
                                                        <!-- sm screen -->
                                                        <div class="col-12 d-block d-lg-none">
                                                            <div class="row">

                                                                <div class=" w-[20%] ml-3 mb-4 pb-5 flex items-center">
                                                                    <div class="card row">
                                                                        <img src="<?php echo $product["image"]; ?>" class="px-1 " width="150px" height="150px" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="w-[65%] flex items-start px-4 mt-3">
                                                                    <div class="row">
                                                                        <p class="fw-semibold text-xl"><?php echo $product["title"]; ?></p><br>
                                                                        <p class="text-[#AD1212] mt-2 text-lg">Rs <?php echo $product["price"]; ?>.00</p>
                                                                        <div class="my-2">
                                                                            <div class="flex items-start justify-start ">

                                                                                <div class="flex justify-end ">
                                                                                    <!-- <i class="bi bi-dash font-semibold bg-[#e6e9eb] rounded-circle px-1 me-3 text-[22px]"></i> -->
                                                                                    <span class="flex items-center pe-2">Qty: </span>
                                                                                    <span class="flex items-center fw-semibold"><?php echo $product["quantity"]; ?></span>
                                                                                    <!-- <i class="bi bi-plus font-semibold mx-2 bg-[#e6e9eb] rounded-circle px-1 ms-3 text-[22px]"></i> -->
                                                                                </div>
                                                                                <i onclick="addToWishlist(<?php echo $product['id']; ?>);" class="bi bi-heart hover:cursor-pointer font-semibold text-end ms-[20px] text-[20px]"></i>
                                                                                <!-- <i class="bi bi-trash3 hover:cursor-pointer font-semibold mx-2 text-[22px] text-[#ed2835]"></i> -->
                                                                            </div>

                                                                        </div>
                                                                        <p class="text-[#999b9e] mt-1"><?php echo $product["condition"]; ?></p>
                                                                        <p class="my-1">Delivery Fee: Rs <?php echo $product["delivery_fee"]; ?>.00</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- sm screen -->
                                                        <hr>
                                                    <?php
                                                    }
                                                    $title = rtrim($title, ",");
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-12">
                                        <div class="row">
                                            <div class="lg:w-[90%] lg:ml-[10%] mt-3 mt-lg-0 border py-3 px-4">
                                                <div class="row">
                                                    <div class="col-6 ">
                                                        <div class="row">
                                                            <p class="fw-semibold text-3xl">Summary</p>
                                                            <div class="flex-row py-2 mt-2">
                                                                <span class="text-center ">Items</span>
                                                            </div>
                                                            <div class="flex-row  py-2"">
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
                                                            <div class="flex-row text-end mt-2 py-2"">
                                            <span class=" text-end"><?php echo $items; ?></span>
                                                            </div>
                                                            <div class="flex-row text-end py-2"">
                                            <span class=" text-end">Rs.<span id="cSubtotle"><?php echo $subtotal; ?></span>.00</span>
                                                            </div>
                                                            <div class="flex-row text-end py-2"">
                                            <span class=" text-end">Rs.<span id="cShipping"><?php echo $shipping; ?></span>.00</span>
                                                            </div>
                                                            <div class="flex-row text-end py-2"">
                                            <span class=" fw-semibold">Rs.<?php $total = $subtotal + $shipping;
                                                                            echo $total; ?>.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $pa = htmlspecialchars(json_encode($productArray));
                                                    ?>
                                                    <button type="submit" id="payhere-payment" onclick="confirmOrder('<?php echo $title; ?>', <?php echo $total; ?>, '<?php echo $pa; ?>');" class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold">Confirm Order</button>

                                                </div>
                                            </div>
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

            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="assets/js/script.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </body>

        </html>
<?php
    }
}
?>
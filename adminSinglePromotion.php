<?php
require_once "libs/connection.php";
session_start();

$process = new Process();
$process->checkAdmin();

class Process
{
    public function checkAdmin()
    {
        if ($_SESSION["admin"]) {
            $email = $_SESSION["admin"]["email"];
            $admin = $this->getAdminByEmail($email);
            if ($admin) {
                $promotion = null;
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $promotion = $this->getPromotionById($id);
                    if ($promotion) {
                        SinglePromotionTemplete::generate($promotion);
                    } else {
                        include "404.php";
                    }
                } else {
                    SinglePromotionTemplete::generate($promotion);
                }
            } else {
                include "404.php";
            }
        } else {
            include "App/views/notLogged_user_templete.php";
        }
    }

    private function getPromotionById($id)
    {
        $result = $this->search("SELECT * FROM `promotions` WHERE `id`='" . $id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getAdminByEmail($email)
    {
        $result = $this->search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }


    private function search($q)
    {
        return Database::search($q);
    }

    private function iud($q)
    {
        Database::iud($q);
    }
}
?>


<?php
class SinglePromotionTemplete
{
    public static function generate($promotion)
    {
?>
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
                        AdminHeaderTemplete::generate();
                        ?>
                        <!-- header -->

                        <!-- add promotion -->
                        <div class="row mt-4 " style="overflow-y: scroll; height:44rem;">
                            <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                                <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold"><?php echo $promotion ? "Edit" : "Add"; ?> Promotion</span>
                            </div>
                            <div class="w-[86%] bg-white pt-2 ps-5 pb-4 pe-5 ml-[7%] ">
                                <div class="flex  items-center p-4 d-none text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" id="promotion_alertBox" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div id="promotion_alert">
                                        <span class="font-medium">Warning!</span> Change a few things up and try submitting again.
                                    </div>
                                </div>
                            </div>
                            <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="row">
                                            <div class="col-lg-4 col-12  justify-center mb-5">
                                                <img src="<?php echo $promotion ? $promotion["image"] : "assets/img/upload.png"; ?>" id="viePromoImg" alt="prmo_img" width="400px" height="400px">
                                                <div class="bg-[#555657] text-center py-[13px] hover:cursor-pointer">
                                                    <label onclick="changeImage();" class="text-white" for="promoImage"><i class="bi bi-upload me-3"></i>Upload Image</label>
                                                    <input <?php echo $promotion ? "disabled" : ""; ?> type="file" class="d-none" id="promoImage" accept="image/*" />
                                                </div>
                                            </div>
                                            <div class="col-lg-7 ms-[60px] ">
                                                <div class="row">
                                                    <textarea <?php echo $promotion ? "disabled" : ""; ?> class="p-3 outline-none border-[1px] border-[#AD1212]" name="" id="promoDescription" cols="30" rows="18"><?php echo $promotion ? $promotion["description"] : ""; ?></textarea>
                                                    <div class="mt-3 text-center">
                                                        <?php
                                                        if ($promotion) {
                                                        ?>
                                                            <button id="editPromoBtn" onclick="editPromotion();" class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Edit Promotion</button>
                                                            <button onclick="updatePromotion(<?php echo $promotion['id']; ?>);" id="updatePromoBtn" class="bg-[#AD1212] w-[40%] text-white d-none p-[14px] rounded ">Update Promotion</button>

                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button onclick="addPromotion();" class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Add Promotion</button>

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
                        <!-- add promotion -->
                    </div>

                </div>
            </div>


            <script src="assets/js/script.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        </body>

        </html>
<?php
    }
}
?>
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
                $promotions = $this->getAllPromotions();
                PromotionsTemplete::generate($promotions);
            } else {
                include "404.php";
            }
        } else {
            include "App/views/notLogged_user_templete.php";
        }
    }

    private function getAllPromotions()
    {
        $result = $this->search("SELECT * FROM `promotions`");
        return $result->num_rows > 0 ? $result : null;
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
class PromotionsTemplete
{
    public static function generate($promotions)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dashboard | ADMIN</title>
            <link rel="icon" href="logo//logoo.png">
            <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <link rel="stylesheet" type="text/css" href="https://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
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

                        <!-- promotions -->
                        <div class="row mt-4">
                            <div class="w-[43%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                                <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Promotions</span>
                            </div>
                            <div class="w-[43%] bg-white pt-5 ps-5 pe-5 pb-5  text-end" onclick="addPromo();">
                                <button class="bg-[#AD1212] text-white p-2 rounded "><i class="bi bi-plus-lg pe-2"></i>Add Promotion</button>
                            </div>
                            <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="row">
                                            <?php
                                            while ($promotion = $promotions->fetch_assoc()) {
                                            ?>
                                                <div onclick="window.location.href = 'adminSinglePromotion?id='+<?php echo $promotion['id']; ?>" class="col-lg-4 hover:cursor-pointer col-12 items-center flex justify-center mb-5">
                                                    <img src="<?php echo $promotion["image"]; ?>" alt="prmo_img" width="400px" height="400px">
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- promotions -->

                    </div>

                </div>
            </div>


            <script src="assets/js/script.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script>
                function addPromo() {
                    localStorage.setItem("activeMenuItem", "");
                    window.location.href = 'adminSinglePromotion';
                }
            </script>
        </body>

        </html>
<?php
    }
}
?>
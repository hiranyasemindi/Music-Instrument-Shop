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
                AdminProfileTemplete::generate($admin);
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
class AdminProfileTemplete
{
    public static function generate($admin)
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
                        ?>
                        <!-- header -->

                        <!-- profile -->
                        <div class="row mt-4 ">
                            <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                                <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Edit Profile</span>
                            </div>

                            <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                                <div class="row">
                                    <div class="w-[25%] ml-[37.5%] justify-center mb-5 ">
                                        <img src="<?php echo $admin["profile_img"]; ?>" class="border w-[90%]" alt="prmo_img" width="400px" height="400px">
                                        <div class="bg-[#555657] w-[90%] text-center py-[13px] hover:cursor-pointer">
                                            <span class="text-white"><i class="bi bi-upload me-3"></i>Upload Image</span>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="row">

                                            <input class="border h-[40%] p-3 focus:outline-none" value="<?php echo $admin["name"]; ?>" type="text" placeholder="Name">
                                            <input class="border h-[40%] p-3 mt-4 focus:outline-none " value="<?php echo $admin["email"]; ?>" type="text" placeholder="Email">


                                            <div class="mt-3 text-center">
                                                <button class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- profile -->
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
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

                        <!-- profile -->
                        <div class="row mt-4 ">
                            <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                                <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Edit Profile</span>
                            </div>

                            <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                                <div class="row">
                                    <div class="w-[25%] ml-[37.5%] justify-center mb-5 ">
                                        <img src="<?php echo $admin["profile_img"]; ?>" id="viewAdminProfileImg" class="border w-[90%]" alt="pro_img" width="400px" height="400px">
                                        <div class="bg-[#555657] w-[90%] text-center py-[13px] hover:cursor-pointer">
                                            <input onchange="updateAdminProfileImage();" type="file" class="d-none" id="adminProfileImg" accept="image/*" />
                                            <label for="adminProfileImg" class="text-white"><i class="bi bi-upload me-3"></i>Upload Image</label>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="row">

                                            <input id="nameAdmin" class="border h-[40%] p-3 focus:outline-none" value="<?php echo $admin["name"]; ?>" type="text" placeholder="Name">
                                            <input id="newEmail" class="border h-[40%] p-3 mt-4 focus:outline-none " value="<?php echo $admin["email"]; ?>" type="text" placeholder="Email">
                                            <input id="oldEmail" class="border h-[40%] p-3 d-none mt-4 focus:outline-none " value="<?php echo $admin["email"]; ?>" type="text" placeholder="Email">

                                            <div class="mt-3 text-center">
                                                <button onclick="updateAdminProfile();" class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- profile -->
                    </div>

                    <!-- Main modal -->
                    <div id="adminModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 mt-[15%] ml-[45%] h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow ">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        Verify Your Email
                                    </h3>
                                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="adminModal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 ">
                                    <form class="space-y-4" action="#">
                                        <div id="fp_alertBox" class="flex items-center p-4 d-none mb-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                            </svg>
                                            <span class="sr-only">Info</span>
                                            <div id="fp_alert">
                                                <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Enter the verification Code</label>
                                            <input type="text" id="vcodeAdmin" placeholder="****" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " required />
                                        </div>

                                        <button onclick="changeEmail();" type="submit" class="w-full mt-4 text-white bg-[#AD1212] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Confirm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main modal -->

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
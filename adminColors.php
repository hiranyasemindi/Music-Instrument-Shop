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
                $colors = $this->getAllColors();
                if (isset($_GET["id"])) {
                    $color_id = $_GET["id"];
                    $color = $this->geColorById($color_id);
                    if ($colors) {
                        SingleColors::generate($color);
                    }
                } else if (isset($_GET["name"])) {
                    SingleColors::generate();
                } else {
                    Color::generate($colors);
                }
            } else {
                include "404.php";
            }
        } else {
            include "App/views/notLogged_user_templete.php";
        }
    }


    private function getAllColors()
    {
        $result = $this->search("SELECT * FROM `color`");
        return $result->num_rows > 0 ? $result : null;
    }


    private function geColorById($id)
    {
        $result = $this->search("SELECT * FROM `color` WHERE `id`='" . $id . "'");
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
class Color
{
    public static function generate($colors)
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


                        <?php
                        Colors::generate($colors);
                        ?>



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


<?php
class Colors
{
    public static function generate($colors)
    {
?>
        <!-- categorys -->
        <div class="row mt-4 orders" id="colors_area">
            <div class="w-[43%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%]">
                <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Colors</span>
            </div>
            <div class="w-[43%] bg-white pt-5 ps-5 pe-5 pb-5  text-end" onclick="addCol();">
                <button class="bg-[#AD1212] text-white p-2 rounded "><i class="bi bi-plus-lg pe-2"></i>Add Color</button>
            </div>
            <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                <div class="row">
                    <table class="table hover:cursor-pointer">
                        <thead class="bg-red-100 ">
                            <tr>
                                <th scope="col">Color ID</th>
                                <th scope="col">Color Name</th>
                                <th scope="col">Color Code</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php
                            $x = 0;
                            while ($color = $colors->fetch_assoc()) {
                            ?>
                                <tr class="border-[#AD1212]" onclick="singleColor(<?php echo $color['id']; ?>);">
                                    <td class="col-2"><?php echo $color["id"]; ?></td>
                                    <td class="col-4"><?php echo $color["color"]; ?></td>
                                    <td class="col-6">
                                        <div class="row">
                                            <div class="w-[10px] col-3 rounded-1 border  bg-[<?php echo $color["code"]; ?>]"></div>
                                            <div class="col-4"><?php echo $color["code"]; ?> </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- categorys -->
<?php
    }
}
?>

<?php
class SingleColors
{
    public static function generate($color = null)
    {
?>
        <!-- add category -->
        <div class="row mt-4" style="overflow-y: scroll; height:44rem;" id="singleBrand_area">
            <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%] ">
                <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold"><?php echo $color ? "Edit" : "Add"; ?> Color</span>
            </div>
            <div class="w-[86%] bg-white pt-2 ps-5 pb-4 pe-5 ml-[7%] ">
                <div class="flex  items-center p-4 d-none text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" id="c_alertBox" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div id="c_alert">
                        <span class="font-medium">Warning!</span> Change a few things up and try submitting again.
                    </div>
                </div>
            </div>
            <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                <div class="row">
                    <div class="col-12 ">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="row">
                                    <input placeholder="Color Name" type="text" value="<?php echo $color ? $color["color"] : ""; ?>" id="c_name" <?php echo $color ? "disabled" : ""; ?> class="p-3 w-[49%] me-[2%] outline-none border-[1px] border-[#AD1212]">
                                    <input placeholder="Color Code" type="text" value="<?php echo $color ? $color["code"] : ""; ?>" id="c_code" <?php echo $color ? "disabled" : ""; ?> class="p-3 w-[49%] outline-none border-[1px] border-[#AD1212]">
                                    <div class="mt-4 text-center">
                                        <?php
                                        if ($color) {
                                        ?>
                                            <button id="editCoBtn" onclick="editColor();" class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Edit Color</button>
                                            <button onclick="updateColor(<?php echo $color['id']; ?>);" id="updateCoBtn" class="bg-[#AD1212] w-[40%] text-white d-none p-[14px] rounded ">Update Color</button>

                                        <?php
                                        } else {
                                        ?>
                                            <button onclick="addColor();" class="bg-[#AD1212] w-[40%] text-white p-[14px] rounded ">Add Color</button>

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
        <!-- add category -->

<?php
    }
}
?>
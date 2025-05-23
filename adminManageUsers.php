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
                $users = $this->getAllUsers();
                ManageUsersTemplete::generate($users);
            } else {
                include "404.php";
            }
        } else {
            include "App/views/notLogged_user_templete.php";
        }
    }

    private function getAllUsers()
    {
        $result = $this->search("SELECT * FROM `user`");
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
class ManageUsersTemplete
{
    public static function generate($users)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dashboard | Manage Users</title>
            <link rel="icon" href="logo//logoo.png">
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

                        <!-- manage users -->
                        <div class="row mt-4 ">
                            <div class="w-[86%] bg-white pt-5 ps-5 pe-5 pb-5 ml-[7%]">
                                <span class="mb-[35px] text-2xl text-[#AD1212] fw-semibold">Manage Users</span>
                            </div>
                            <div class="w-[86%] bg-white pb-5 pe-5 ps-5 ml-[7%]" style="overflow-y: scroll; height:36rem;">
                                <div class="row">
                                    <table class="table  hover:cursor-pointer">
                                        <thead class="bg-red-100 ">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Registered Date</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <?php
                                            while ($user = $users->fetch_assoc()) {
                                            ?>
                                                <tr class="border-[#AD1212]">
                                                    <th scope="row">
                                                        <img src="<?php echo $user['profile_img']; ?>" class="rounded-circle" width="30px" height="30px" alt="">
                                                    </th>
                                                    <td><?php echo $user["fname"] . " " . $user["lname"]; ?></td>
                                                    <td><?php echo $user["email"]; ?></td>
                                                    <td><?php echo $user["joined_date"]; ?></td>

                                                    <td>
                                                        <?php
                                                        $status = $user["status_id"];
                                                        if ($status == 1) {
                                                        ?>
                                                            <div onclick="ActivateOrDeactivateUser(2, '<?php echo $user['email']; ?>');" class="bg-[#F7CECE] text-center p-1 rounded hover:cursor-pointer">
                                                                <span class="text-[#E63535]">Deactivate</span>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div onclick="ActivateOrDeactivateUser(1,'<?php echo $user['email']; ?>');" class="bg-[#C9F0DD] text-center p-1 rounded hover:cursor-pointer">
                                                                <span class="text-[#18BA6B]">Activate</span>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
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
                        <!-- manage users -->

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
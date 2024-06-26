<?php
require_once "libs/connection.php";
session_start();

$process = new Process();
$process->checkUser();
class Process
{
    public function checkUser()
    {
        if (isset($_SESSION['user'])) {
            $this->loggedUser();
        } else {
            $this->notLoggedUser();
        }
    }

    private function loggedUser()
    {
        $email = $_SESSION["user"]["email"];
        $user = $this->getUserByEmail($email);
        if ($user) {
            $name = $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"];
            $date = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $date->setTimezone($tz);
            $today = $date->format("Y-m-d");
            $products = $this->getProducts();
            $reservations = $this->getReservations($email);;
            Reservation::generate($name, $today, $products, $reservations);
        } else {
            include "App/views/404.php";
        }
    }

    private function notLoggedUser()
    {
        include "App/views/notLogged_user_templete.php";
    }

    private function getUserByEmail($email)
    {
        $result = $this->search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getProducts()
    {
        $result = $this->search("SELECT `id`,`title` FROM `product` WHERE `status_id`='1' ORDER BY `title` ASC");
        return $result->num_rows > 0 ? $result : null;
    }

    private function getReservations($email)
    {
        $result = $this->search("SELECT * FROM `reservation` INNER JOIN `product` ON `product`.`id`=`reservation`.`product_id` WHERE `user_email`='" . $email . "' ");
        return $result->num_rows > 0 ? $result : null;
    }

    private function search($q)
    {
        return Database::search($q);
    }
}
?>

<?php
class Reservation
{
    public static function generate($name, $date, $products, $reservations)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Home | SONORITY</title>
            <link rel="icon" href="logo//logoo.png">
            <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        </head>

        <body>
            <?php
            include "App/includes/header.php";
            ?>
            <div class="container-fluid mb-5">
                <div class="row">

                    <div class="col-12">
                        <div class="row">
                            <div class="p-4 mt-4 pt-5">
                                <h2 class="text-3xl font-bold">Make a Reservation</h2>
                                <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                                <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                            </div>
                            <div class="col-5  content-center items-center flex-row">
                                <div class="row">
                                    <div class="col-10 offset-2   content-center items-center">
                                        <div class="row">
                                            <img class="w-full" src="assets/img/reservation.jpg" alt="reservation_img" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-8 offset-2">
                                        <div class="row">
                                            <span class="fw-semibold">Reserver's Name</span>
                                            <input disabled class="border h-[40%] p-3 mt-3 focus:outline-none mt-3" type="text" value="<?php echo $name; ?>">
                                            <span class="fw-semibold mt-4">Product for reservation</span>
                                            <select class="border h-[40%]  focus:outline-none p-3 mt-3" name="" id="product">
                                                <option value="0">Select Product</option>
                                                <?php
                                                for ($i = 0; $i < $products->num_rows; $i++) {
                                                    $product = $products->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $product["id"]; ?>"><?php echo $product["title"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <span class="fw-semibold mt-4">Reservation Pickup Date</span>
                                            <input id="pickup" class="border h-[40%] p-3 mt-3 focus:outline-none mt-3" type="date">
                                            <span class="fw-semibold mt-4">Reservation Date</span>
                                            <input id="date" disabled value="<?php echo $date; ?>" class="border h-[40%] p-3 mt-3 focus:outline-none mt-3" type="text">
                                            <button class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold" onclick="addReservation();">Make Reservation</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-10 offset-1 mb-4 mt-[8rem]">
                        <div class="row">
                            <?php
                            if ($reservations) {
                                while ($reservation = $reservations->fetch_assoc()) {
                            ?>
                                    <table class="table-sm hover:cursor-pointer">
                                        <thead class=" ">
                                            <tr class="h-[20px]">
                                                <th scope="col">Reservation ID</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Reservation Date</th>
                                                <th scope="col">Pickup Date</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <?php
                                            while ($reservation = $reservations->fetch_assoc()) {
                                            ?>
                                                <tr class="border-[#AD1212] mt-3 ">
                                                    <th scope="row">
                                                        <?php echo $reservation['reservation_id']; ?>
                                                    </th>
                                                    <!-- <td><?php echo $reservation["user_email"]; ?></td> -->
                                                    <td><?php echo $reservation["title"]; ?></td>
                                                    <td><?php echo $reservation["reservation_date"]; ?></td>
                                                    <td><?php echo $reservation["pickup_date"]; ?></td>

                                                    <td>
                                                        <?php
                                                        $status = $reservation["reservation_status_status_id"];
                                                        if ($status == 1) {
                                                        ?>
                                                            <div class="bg-[#F7CECE] text-center p-1 rounded hover:cursor-pointer">
                                                                <span class="text-[#E63535]">Pending</span>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="bg-[#C9F0DD] text-center p-1 rounded hover:cursor-pointer">
                                                                <span class="text-[#18BA6B]">Confirmed</span>
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
                                <?php
                                }
                            } else {
                                ?>
                                <span class="fw-semibold">No Resevations Yet</span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>

            <?php include "App/includes/footer.php"; ?>
            <script src="assets/js/script.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </body>

        </html>
<?php
    }
}
?>
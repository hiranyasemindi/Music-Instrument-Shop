<?php
require "libs/connection.php";
$process = new Process();
$process->handleRequest();
class Process
{
    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->handleGETRequest();
        } else {
            include "404.php";
        }
    }

    public function handleGETRequest()
    {
        if (isset($_GET["id"])) {
            $promo_id = $_GET["id"];
            $promotion = $this->getPromotion($promo_id);
            if ($promotion) {
                PromotionTemplete::generate($promotion);
            } else {
                include "404.php";
            }
        } else {
            include "404.php";
        }
    }

    private function getPromotion($promo_id)
    {
        $result = $this->search("SELECT * FROM `promotions` WHERE `id`='" . $promo_id . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function search($q)
    {
        return Database::search($q);
    }
}
?>

<?php
class PromotionTemplete
{
    public static function generate($promotion)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>PROMOTION | SONORITY</title>
            <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        </head>

        <body>

            <?php include "App/includes/header.php"; ?>

            <div class="container-fluid mb-5">
                <div class="row">

                    <div class="col-12 mt-5 mt-lg-4">
                        <div class="row">
                            <div class="col-lg-8 col-10 offset-1 flex items-center justify-center offset-lg-2">
                                <img src="<?php echo $promotion["image"];  ?>" alt="promo_img" width="500px" height="500px">
                            </div>
                            <div class="col-lg-8 col-10 flex items-center justify-center offset-1 offset-lg-2 mt-5 mt-lg-4">
                                <p><?php echo $promotion["description"]; ?></p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            </div>

            <?php include "App/includes/footer.php"; ?>
            <script src="assets/js/script.js"></script>
        </body>

        </html>
<?php
    }
}
?>
<?php
require_once "../Music_Shop/libs/connection.php";

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

    private function handleGETRequest()
    {
        $promotions = $this->getPromotions();
        if ($promotions) {
            PromotionsTemplete::generate($promotions);
        } else {
            include "empty.php";
            EmptyDesign::generate("Promotions not Avalable");
        }
    }

    private function getPromotions()
    {
        $result = $this->search("SELECT * FROM `promotions` ORDER BY `date` ASC");
        return $result->num_rows > 0 ? $result : null;
    }

    private function search($q)
    {
        return Database::search($q);
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
            <title>Document</title>
            <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        </head>

        <body>

            <?php include "App/includes/header.php"; ?>

            <div class="container-fluid mb-5">
                <div class="row">

                    <div class="col-12">
                        <div class="row">

                            <div class="p-4 mt-4 pt-5">
                                <h2 class="text-3xl font-bold">Promotions</h2>
                                <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                                <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                            </div>


                            <div class="col-10 offset-1 ">
                                <div class="row">
                                    <?php
                                    while ($promotion = $promotions->fetch_assoc()) {
                                    ?>
                                        <div class="col-lg-4 hover:cursor-pointer col-12 items-center flex justify-center mt-5" onclick="window.location.href = 'singlePromoView.php?id=<?php echo $promotion['id']; ?>'">
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
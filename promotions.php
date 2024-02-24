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
                        <div class="bg-[#E7B94E] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                        <div class="bg-[#E7B94E] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                    </div>


                    <div class="col-10 offset-1 ">
                        <div class="row">
                            <?php
                            for ($x = 0; $x < 5; $x++) {
                            ?>
                                <div class="col-lg-4 col-12 items-center flex justify-center mt-5">
                                    <img src="assets/img/image 15.png" alt="prmo_img" width="400px" height="400px">
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
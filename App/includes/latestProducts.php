<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/plugin/semantic/css/semantic.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <title>Document</title>
    <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
</head>

<body>

    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@100;500&family=Padauk&family=Roboto:wght@100&display=swap'); */
        .scroll-images-latest {
            width: 100%;
            height: 350px;
            display: flex;
            justify-content: left;
            align-items: center;
            overflow-x: scroll;
            position: relative;
            scroll-behavior: smooth;
        }

        @media only screen and (max-width: 600px) {
            .scroll-images-latest {
                width: 100%;
                height: 250px;
                display: flex;
                justify-content: left;
                align-items: center;
                overflow: auto;
                position: relative;
                scroll-behavior: smooth;
            }
        }
    </style>

    <?php
    class LatestProductsTemplete
    {
        public static function generate($latestProducts)
        {
    ?>
            <div class="text-center col-12 ">
                <div class="row align-items-center">
                    <div class="col-1 text-end d-none d-lg-block">
                        <i class="bi bi-caret-left-fill text-3xl hover:pointer" id="previous-latest"></i>
                    </div>
                    <div class="relative h-[40%] col-lg-10 col-12" id="cover-latest">
                        <div class="scroll-images-latest text-center ">
                            <?php
                            while ($product = $latestProducts->fetch_assoc()) {
                            ?>
                                <div class="col-6 col-lg-3 mt-3">
                                    <div class="row">
                                        <div class="col-10 offset-1 shadow card">

                                            <div class="flex items-center justify-center">
                                                <img src="<?php echo $product["image_path"]; ?>" alt="product_img" width="200px" height="200px">
                                            </div>

                                            <div class="row product-onclick-view justify-content-center align-content-center " style="position: absolute;" id="hover-view">
                                                <div style="width: 100%;">
                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                                            <p class="text-center text-xl" style="color: #FFFFFF; "><?php echo $product["title"]; ?></p>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center mt-2 mb-2" style="height: 100%;">
                                                            <p class="text-center fw-bold text-2xl" style="color: #fcb3b3;">Rs. <?php echo $product["price"]; ?>.00</p>
                                                        </div>

                                                        <div class="d-flex align-items-center justify-content-center mt-2 mb-1" style="height: 100%;">
                                                            <span class="col-2 text-center text-lg-end fw-bold" style="color: #AD1212;"><?php echo $product["rating"]; ?>.0</span>

                                                            <span class="col-6">
                                                                <?php
                                                                $fill = $product["rating"];
                                                                for ($x = 0; $x < 5; $x++) {
                                                                    $starClass = ($x < $fill) ? "bi bi-star-fill" : "bi bi-star";
                                                                ?>
                                                                    <i class="<?php echo $starClass; ?> p-1" style="color: #AD1212;"></i>
                                                                <?php
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="width: 100%;" class="mt-3 text-center  align-items-center">
                                                    <div class="product-dot col-12 ">
                                                        <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                                            <div onclick="addToWishlist(<?php echo $product['id']; ?>);" class="col-2 d-flex justify-content-center align-items-center" style="color: #AD1212; border-radius: 50%; width: 2.5rem; height: 2.5rem; background-color: #fcb3b3;">
                                                                <i class="bi bi-heart fs-5 mt-1"></i>
                                                            </div>
                                                            <div class="col-1"></div>
                                                            <div onclick="addToCart(<?php echo $product['id']; ?>);" class="col-2 d-flex justify-content-center align-items-center" style="color: #AD1212; border-radius: 50%; width: 2.5rem; height: 2.5rem; background-color: #fcb3b3;">
                                                                <i class="bi bi-bag fs-5"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-1 text-start d-none d-lg-block">
                        <i class="bi bi-caret-right-fill text-3xl" id="next-latest" class="arrow"></i>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
        $(document).ready(() => {
            $(function() {
                let isMobile = window.matchMedia(
                    "only screen and (max-width: 600px)"
                ).matches;
                var scrollValue = 0;

                // chech mobile device or large device screens
                if (isMobile) {
                    scrollValue = 500;

                    $("#next-latest").click(() => {
                        document.querySelector(".scroll-images-latest").scrollBy(scrollValue, 0);
                    });
                    $("#previous-latest").click(() => {
                        document.querySelector(".scroll-images-latest").scrollBy(-scrollValue, 0);
                    });

                } else {
                    scrollValue = 400;

                    $("#next-latest").click(() => {
                        document.querySelector(".scroll-images-latest").scrollBy(scrollValue, 0);
                    });

                    $("#previous-latest").click(() => {
                        document.querySelector(".scroll-images-latest").scrollBy(-scrollValue, 0);
                    });
                }
            });
        });
    </script>

</body>

</html>
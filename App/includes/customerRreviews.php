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
        .scroll-images-customerreviews {
            width: 100%;
            height: 450px;
            display: flex;
            justify-content: left;
            align-items: center;
            overflow-x: scroll;
            position: relative;
            scroll-behavior: smooth;
        }

        @media only screen and (max-width: 600px) {
            .scroll-images-customerreviews {
                width: 100%;
                height: 400px;
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
    class CutomerReviewsTemplete
    {
        public static function generate($customerReviews)
        {
    ?>
            <div class="text-center col-12 ">
                <div class="row align-items-center">
                    <div class="col-1 text-end d-none d-lg-block">
                        <i class="bi bi-caret-left-fill text-3xl hover:pointer" id="previous-customerreviews"></i>
                    </div>
                    <div class="relative h-[40%] col-lg-10 col-12" id="cover-customerreviews">
                        <div class="scroll-images-customerreviews text-center ">
                            <?php
                            while ($review = $customerReviews->fetch_assoc()) {
                            ?>
                                <div class="col-lg-4 col-12 items-center">
                                    <div class="row justfy-center">
                                        <div class="col-10 offset-1 h-[20rem] shadow text-center">
                                            <div class="flex mb-2 items-center justify-center mt-4">
                                                <img class="rounded-circle" width="50px" src="<?php echo $review["profile_img"] ? $review["profile_img"] : "assets/img/round_profil_picture_before_.png";  ?>" alt="">
                                            </div>
                                            <span class="font-bold text-lg"><?php echo $review["fname"] . " " . $review["lname"]; ?></span>
                                            <div class="px-4">
                                                <p class="text-md py-4 text-[#999b9e]">
                                                    "<?php echo $review["review"];  ?>"
                                                </p>
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
                        <i class="bi bi-caret-right-fill text-3xl" id="next-customerreviews" class="arrow"></i>
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

                    $("#next-customerreviews").click(() => {
                        document.querySelector(".scroll-images-customerreviews").scrollBy(scrollValue, 0);
                    });
                    $("#previous-customerreviews").click(() => {
                        document.querySelector(".scroll-images-customerreviews").scrollBy(-scrollValue, 0);
                    });

                } else {
                    scrollValue = 400;

                    $("#next-customerreviews").click(() => {
                        document.querySelector(".scroll-images-customerreviews").scrollBy(scrollValue, 0);
                    });

                    $("#previous-customerreviews").click(() => {
                        document.querySelector(".scroll-images-customerreviews").scrollBy(-scrollValue, 0);
                    });
                }
            });
        });
    </script>

</body>

</html>
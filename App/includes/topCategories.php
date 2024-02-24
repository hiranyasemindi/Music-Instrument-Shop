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
        .scroll-images-top {
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
            .scroll-images-top {
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

    <div class="text-center col-12 ">
        <div class="row align-items-center">
            <div class="col-1 text-end d-none d-lg-block">
                <i class="bi bi-caret-left-fill text-3xl hover:pointer" id="previous-topCateg"></i>
            </div>
            <div class="relative h-[40%] col-lg-10 col-12" id="cover-top">
                <div class="scroll-images-top text-center ">
                    <?php
                    for ($x = 0; $x < 10; $x++) {
                    ?>
                        <div class="col-6 col-lg-3 mt-3">
                            <div class="row">
                                <div class="col-10 flex items-center justify-center shadow ">
                                    <img src="assets/img/drum.jpg" alt="" width="200px" height="200px">
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-1 text-start d-none d-lg-block">
                <i class="bi bi-caret-right-fill text-3xl" id="next-topCateg" class="arrow"></i>
            </div>
        </div>
    </div>

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

                    $("#next-topCateg").click(() => {
                        document.querySelector(".scroll-images-top").scrollBy(scrollValue, 0);
                    });
                    $("#previous-topCateg").click(() => {
                        document.querySelector(".scroll-images-top").scrollBy(-scrollValue, 0);
                    });

                } else {
                    scrollValue = 400;

                    $("#next-topCateg").click(() => {
                        document.querySelector(".scroll-images-top").scrollBy(scrollValue, 0);
                    });

                    $("#previous-topCateg").click(() => {
                        document.querySelector(".scroll-images-top").scrollBy(-scrollValue, 0);
                    });
                }
            });
        });
    </script>

</body>

</html>
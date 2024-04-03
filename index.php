<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME | SONORITY</title>
    <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    include "App/includes/header.php";
    require_once "libs/connection.php";
    ?>

    <?php
    class Process
    {
        public function getTrendingCategories()
        {
            $result = $this->search("SELECT DISTINCT `category`.`id`, `category`.`name`, `category`.`img_path`
            FROM (
            SELECT product_id, COUNT(`qty`) AS `sold_product_count`
                FROM `invoice` INNER JOIN `invoice_item` ON `invoice`.`order_id`=`invoice_item`.`invoice_order_id`
                GROUP BY `product_id`
            ) AS `most_sold_products`
            JOIN `product` ON `most_sold_products`.`product_id` = `product`.`id`
            INNER JOIN `category` ON `category`.`id`=`product`.`category_id`
            LIMIT 10;");
            return $result->num_rows > 0 ? $result : null;
        }

        public function getLatestProducts()
        {
            $result = $this->search("SELECT `id`,`title`,`price`,`rating`,`image_path` FROM product WHERE `status_id`='1' ORDER BY `added_date` DESC LIMIT 15");
            return $result->num_rows > 0 ? $result : null;
        }

        public function getCustomerReviews()
        {
            $result = $this->search("SELECT `review`,`fname`,`lname`,`profile_img` FROM `reviews` INNER JOIN `user` ON `user`.`email`=`reviews`.`user_email`");
            return $result->num_rows > 0 ? $result : null;
        }

        private function search($q)
        {
            return Database::search($q);
        }
    }
    $process = new Process();
    ?>

    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-12 bg-cover mt-3 mt-lg-0 bg-center bg-no-repeat h-[35rem] items-center flex" style="background-image: url('assets/img/acoustic-guitar-snare-drum-black-background-isolated.jpg')">
                <!-- <img src="logo/logoo.png" alt="logo" width="400px" height="400px" class="d-none d-lg-block"> -->
            </div>
            <div class="col-12">
                <div class="row">

                    <div class="p-4">
                        <h2 class="text-3xl font-bold">Trending Categories</h2>
                        <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                        <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                    </div>
                    <?php
                    include "App/includes/topCategories.php";
                    $categories = $process->getTrendingCategories();
                    if ($categories) {
                        TrendingCategoriesTemplete::generate($categories);
                    } else {
                        echo "No categories available.";
                    }
                    ?>

                    <div class="p-4 mt-5">
                        <h2 class="text-3xl font-bold">Lastest Arrivals</h2>
                        <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                        <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                    </div>
                    <?php
                    include "App/includes/latestProducts.php";
                    $latestProducts = $process->getLatestProducts();
                    if ($latestProducts) {
                        LatestProductsTemplete::generate($latestProducts);
                    } else {
                        echo "No products available.";
                    }
                    ?>

                    <div class="col-10 offset-1 mt-5">
                        <div class="row mt-5">
                            <div class="col-lg-7 col-12 ">
                                <img src="assets/img/acoustic-guitar-drums-keys-black-background.jpg" alt="" width="700px" height="700px">
                            </div>
                            <div class="col-lg-5 py-3 col-12 items-center justify-center mt-3 mt-lg-0">
                                <h2 class="text-3xl font-bold">Best Edition</h2>
                                <div class="bg-[#AD1212] my-3 h-1 w-[80%] ml-[2%] rounded"></div>
                                <p class="text-lg py-4 text-[#999b9e]">Discover the pinnacle of craftsmanship and precision with our selection of best editions at Sonority Music Shop.
                                    We curate only the finest instruments, meticulously crafted by renowned artisans and revered brands,
                                    ensuring unparalleled quality and performance for musicians of all levels. From exquisite limited editions
                                    to timeless classics, each instrument in our collection represents the epitome of excellence in design, tone,
                                    and playability. Elevate your musical journey with our best editions, where every instrument is a masterpiece
                                    waiting to inspire your creativity and elevate your performance to new heights. Explore our exclusive range
                                    today and experience the artistry that defines true perfection in music.</p>
                                <button onclick="window.location.href = 'products'" class="bg-[#AD1212] mt-2 rounded px-5 py-3 text-white font-bold">View More</button>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 mt-5 pt-5">
                        <h2 class="text-3xl font-bold">Customer Reviews</h2>
                        <div class="bg-[#AD1212] my-3 h-1 w-[20%] d-none d-lg-block ml-[2%] rounded"></div>
                        <div class="bg-[#AD1212] my-2 h-[2px] w-[60%] d-block d-lg-none ml-[2%] rounded"></div>
                    </div>
                    <?php
                    include "App/includes/customerRreviews.php";
                    $customerReviews = $process->getCustomerReviews();
                    if ($customerReviews) {
                        CutomerReviewsTemplete::generate($customerReviews);
                    } else {
                        echo "No reviews available.";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <?php include "App/includes/footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var scrollAmount = 200;
            $("#previousButton").click(function() {
                $("#cardContainer").animate({
                    scrollLeft: "-=" + scrollAmount
                }, "slow");
            });
            $("#nextButton").click(function() {
                $("#cardContainer").animate({
                    scrollLeft: "+=" + scrollAmount
                }, "slow");
            });
        });
    </script>
</body>

</html>
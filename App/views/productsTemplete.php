<?php
static $brandsArray = [];
class ProductsTemplete
{
    public static function generate($rows, $query, $categories, $brands, $models, $colors)
    {

        $categoriesArray = [];
        while ($category = $categories->fetch_assoc()) {
            $categoriesArray[] = $category;
        }

        $colorsArray = [];
        while ($color = $colors->fetch_assoc()) {
            $colorsArray[] = $color;
        }
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Products | SONORITY</title>
            <link rel="icon" href="logo//logoo.png">
            <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        </head>

        <body>
            <?php include "App/includes/header.php"; ?>
            <div class="container-fluid mb-5">
                <div class="row">

                    <div class="col-12">
                        <div class="row">

                            <!-- filter area lg -->
                            <div class="col-lg-3 d-none d-lg-block  ">
                                <div class="row">
                                    <div class="w-[90%] ml-[5%] border">
                                        <div class="row">
                                            <p class="text-2xl p-3 fw-semibold">Filter Products</p>
                                            <p class="ps-4 pt-4 text-lg">Category</p>
                                            <div class="w-[90%] ml-[5%] mt-2">
                                                <div class="row">
                                                    <select onchange="loadModelsandBrands();" class="h-[40%]  border focus:outline-none p-3 mt-1" id="category">
                                                        <option value="0">Select Category</option>
                                                        <?php
                                                        foreach ($categoriesArray as $category) {
                                                        ?>
                                                            <option value="<?php echo $category["id"]; ?>" <?php if (isset($_GET["id"])) {
                                                                                                                if ($category["id"] == $_GET["id"]) {
                                                                                                                    echo "selected";
                                                                                                                }
                                                                                                            } ?>><?php echo $category["name"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="brandmodelview">
                                                <?php
                                                BrandModelsTemplete::generate($brands, $models, 1);
                                                ?>
                                            </div>
                                            <p class="ps-4 pt-4 text-lg">Price</p>
                                            <div class="w-[90%]  ml-[5%]">
                                                <div class="row">
                                                    <input type="text" id="minPrice" class="me-[2%] border h-[50px] w-[49%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Min">
                                                    <input type="text" id="maxPrice" class="border h-[50px] w-[49%]  p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Max">
                                                </div>
                                            </div>
                                            <p class="ps-4 pt-4 text-lg">Color Family</p>
                                            <div class="w-[90%] ml-[5%] mt-3">
                                                <div class="row">
                                                    <?php
                                                    foreach ($colorsArray as $color) {
                                                    ?>
                                                        <div data-code="<?php echo $color["id"]; ?>" class="w-[32%] color-option border-[#AD1212] flex items-center justify-center hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                            <div class="w-[15px] rounded-1  h-[15px] bg-[<?php echo $color["code"]; ?>]"></div>
                                                            <div class="ms-1 w-[50%]">
                                                                <?php echo $color["color"]; ?>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <p class="ps-4 pt-4 text-lg">Rating</p>

                                            <div class="w-[90%] ml-[5%] mt-3">
                                                <div class="row">
                                                    <?php
                                                    for ($x = 1; $x < 6; $x++) {
                                                    ?>
                                                        <div data-code="<?php echo $x; ?>" class="rating-option border-[#AD1212] w-[24%] flex items-center justify-center hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                            <i class="bi bi-star-fill text-yellow-500 font-semibold hover:cursor-pointer "></i>

                                                            <div class="ms-2">
                                                                <?php echo $x; ?>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <p class="ps-4 pt-4 text-lg">Sort Products</p>
                                            <select id="sort" class="w-[90%] ml-[5%]  border h-[40%]  focus:outline-none p-3 mt-3">
                                                <option value="0">Select Sort Option</option>
                                                <option value="1">Price Law to High</option>
                                                <option value="2">Price High to Law</option>
                                                <option value="3">Quantity Law to High</option>
                                                <option value="4">Quantity High to Law</option>
                                            </select>
                                            <div class="mb-3">
                                                <button onclick="clearSearch();" class="border  w-[45%] ms-[2%] me-[3%] rounded px-5 py-[12px] mt-4 text-[#AD1212] font-bold" style="border-color:#AD1212 ;">Clear</button>
                                                <button onclick="filter();" class="bg-[#AD1212] w-[45%]  rounded px-5 py-[12px] mt-4 text-white font-bold">Apply</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- filter area lg -->

                            <!-- filter area sm -->
                            <div class="col-12 p-3 d-block d-lg-none ">
                                <!-- drawer init and toggle -->
                                <div class="text-end me-3">
                                    <button type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
                                        <i class="bi bi-funnel-fill text-[#AD1212] "></i><span class="text-[#AD1212] ps-2">Filter</span>
                                    </button>

                                </div>

                                <!-- drawer component -->
                                <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
                                    <h5 id="drawer-right-label" class="inline-flex items-start mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>Filter</h5>
                                    <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close menu</span>
                                    </button>
                                    <div class="w-[90%] ml-[5%]">
                                        <div class="row">
                                            <p class="text-2xl p-3 fw-semibold">Filter Products</p>
                                            <p class="ps-4 pt-4 text-lg">Category</p>
                                            <div class="w-[90%] ml-[5%] mt-2">
                                                <div class="row">
                                                    <select onchange="loadModelsandBrands();" class="h-[40%]  border focus:outline-none p-3 mt-1" id="category">
                                                        <option value="0">Select Category</option>
                                                        <?php
                                                        foreach ($categoriesArray as $category) {
                                                        ?>
                                                            <option value="<?php echo $category["id"]; ?>" <?php if (isset($_GET["id"])) {
                                                                                                                if ($category["id"] == $_GET["id"]) {
                                                                                                                    echo "selected";
                                                                                                                }
                                                                                                            } ?>><?php echo $category["name"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-12 " id="brandmodelview">
                                                <div class="row">
                                                    <?php
                                                    BrandModelsTemplete::generate($brands, $models, 1);
                                                    ?>
                                                </div>
                                            </div>
                                            <p class="ps-4 pt-4 text-lg">Price</p>
                                            <div class="w-[90%]  ml-[5%]">
                                                <div class="row">
                                                    <input type="text" id="minPrice" class="me-[2%] border h-[50px] w-[49%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Min">
                                                    <input type="text" id="maxPrice" class="border h-[50px] w-[49%]  p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Max">
                                                </div>
                                            </div>
                                            <p class="ps-4 pt-4 text-lg">Color Family</p>
                                            <div class="w-[90%] ml-[5%] mt-3">
                                                <div class="row">
                                                    <?php
                                                    foreach ($colorsArray as $color) {
                                                    ?>
                                                        <div data-code="<?php echo $color["id"]; ?>" class="w-[32%] color-option border-[#AD1212] flex items-center justify-center hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                            <div class="w-[15px] rounded-1  h-[15px] bg-[<?php echo $color["code"]; ?>]"></div>
                                                            <div class="ms-1 w-[50%]">
                                                                <?php echo $color["color"]; ?>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <p class="ps-4 pt-4 text-lg">Rating</p>

                                            <div class="w-[90%] ml-[5%] mt-3">
                                                <div class="row">
                                                    <?php
                                                    for ($x = 1; $x < 6; $x++) {
                                                    ?>
                                                        <div data-code="<?php echo $x; ?>" class="rating-option border-[#AD1212] w-[24%] flex items-center justify-center hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                            <i class="bi bi-star-fill text-yellow-500 font-semibold hover:cursor-pointer "></i>

                                                            <div class="ms-2">
                                                                <?php echo $x; ?>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <p class="ps-4 pt-4 text-lg">Sort Products</p>
                                            <select id="sort" class="w-[90%] ml-[5%]  border h-[40%]  focus:outline-none p-3 mt-3">
                                                <option value="0">Select Sort Option</option>
                                                <option value="1">Price Law to High</option>
                                                <option value="2">Price High to Law</option>
                                                <option value="3">Quantity Law to High</option>
                                                <option value="4">Quantity High to Law</option>
                                            </select>
                                            <div class="mb-3">
                                                <button onclick="clearSearch();" class="border  w-[45%] ms-[2%] me-[3%] rounded px-5 py-[12px] mt-4 text-[#AD1212] font-bold" style="border-color:#AD1212 ;">Clear</button>
                                                <button onclick="filter();" class="bg-[#AD1212] w-[45%]  rounded px-5 py-[12px] mt-4 text-white font-bold">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- filter area sm -->

                            <div class="col-12 col-lg-9" id="products-area">

                                <?php


                                DisplayProductsTemplete::generate($rows, $query);
                                ?>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            </div>
            <?php include "App/includes/footer.php"; ?>

            <script src="assets/js/script.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="assets/plugin/bootstrap/js/bootstrap.bundle.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        </body>

        </html>
<?php
    }
}
?>

<?php
class DisplayProductsTemplete
{
    public static function executeQuery($query, $limit, $offset)
    {
        $result = Database::search($query . " LIMIT " . $limit . " OFFSET " . $offset . "");
        return $result->num_rows > 0 ? $result : null;
    }

    public static function generate($rows, $query)
    {
        if (isset($_GET["page"])) {
            $pageno = $_GET["page"];
        } else {
            $pageno = 1;
        }

        $productsCount = $rows;
        $resultsPerPage = 1;
        $numberOfPages = ceil($productsCount / $resultsPerPage);

        $offset = ($pageno - 1) * $resultsPerPage;
        $limitedProducts = self::executeQuery($query, $resultsPerPage, $offset);
        if (!empty($limitedProducts)) {

?>
            <!-- products -->

            <div class=" col-12">
                <div class="row">
                    <?php
                    while ($product = $limitedProducts->fetch_assoc()) {
                    ?>
                        <div class="col-12 col-lg-3 mb-5">
                            <div class="row">
                                <div class="col-10 offset-1  card">

                                    <div class="flex items-center justify-center">
                                        <img src="<?php echo $product["image_path"]; ?>" alt="product_img" width="200px" height="200px">
                                    </div>

                                    <div class="row product-onclick-view justify-content-center align-content-center " style="position: absolute;" id="hover-view">
                                        <div style="width: 100%;">
                                            <div class="col-12">

                                            </div>
                                        </div>

                                        <div style="width: 100%;" class="mt-3 text-center  align-items-center">
                                            <div class="product-dot col-12 ">
                                                <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                                    <div onclick="window.location.href = 'singleProductView?id=<?php echo $product['id']; ?>'" class="col-2 d-flex justify-content-center align-items-center" style="color: #AD1212; border-radius: 50%; width: 2.5rem; height: 2.5rem; background-color: #fcb3b3;">
                                                        <i class="bi bi-eye fs-5"></i>
                                                    </div>
                                                    <div class="col-1"></div>
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
                                <div class="p-3 text-center col-10 offset-1 h-[180px] border shadow-sm justify-center">
                                    <p class="sm:text-sm lg:text-lg"><?php echo $product["title"]; ?></p>
                                    <p class="lg:text-lg sm:text-xs mt-2 fw-semibold">Rs.<?php echo $product["price"]; ?>.00</p>
                                    <div class=" mt-2">
                                        <span class="col-lg-2 col-1 text-center lg:text-lg-end sm:text-sm-end  fw-bold" style="color: #AD1212;"><?php echo $product["rating"]; ?>.0</span>

                                        <span class="col-lg-6 col-11">
                                            <?php
                                            $fill = $product["rating"];
                                            for ($x = 0; $x < 5; $x++) {
                                                $starClass = ($x < $fill) ? "bi bi-star-fill" : "bi bi-star";
                                            ?>
                                                <i class="<?php echo $starClass; ?> p-lg-1 p-0 lg:text-lg sm:text-xs" style="color: #AD1212;"></i>
                                            <?php
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <!-- products -->

            <!-- pagination -->
            <div class="text-center">
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px text-base h-10">
                        <li>
                            <a href="<?php if ($pageno <= 1) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno - 1);
                                        } ?>" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                        </li>
                        <?php
                        // echo $numberOfPages;
                        for ($p = 0; $p < $numberOfPages; $p++) {
                            # code...
                            if ($pageno == $p + 1) {
                        ?>
                                <li>
                                    <a href="<?php echo "?page=" . $p + 1 ?>" aria-current="page" class="flex items-center justify-center px-4 h-10 text-[#AD1212] border border-gray-300 bg-red-50 hover:bg-red-100 hover:text-red-700 dark:border-gray-700 dark:bg-gray-700 dark:text-[#AD1212]"><?php echo $p + 1; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>

                                <li>
                                    <a href="<?php echo "?page=" . $p + 1 ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?php echo $p + 1; ?></a>
                                </li>
                        <?php
                            }
                        }
                        ?>

                        <li>
                            <?php
                            ?>
                            <a href="<?php if ($pageno >= $numberOfPages) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno + 1);
                                        } ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php
        } else {
            include "empty.php";
            EmptyDesign::generate("Products not Available");
        }
        ?>

<?php
    }
}
?>



<?php
class BrandModelsTemplete
{
    private static $brandsArray;

    public static function generate($brands, $models, $status)
    {

        while ($brand = $brands->fetch_assoc()) {
            self::$brandsArray[] = $brand;
        }

?>
        <p class="ps-4 pt-4 text-lg">Brand</p>
        <div class="w-[90%] ml-[5%] mt-2">
            <div class="row">
                <select onchange="loadBrands();" class="h-[40%]  border focus:outline-none p-3 " id="brand">
                    <option value="0">Select Brand</option>
                    <?php
                    foreach (self::$brandsArray as $brand) {
                    ?>
                        <option value="<?php echo $brand["brand_id"]; ?>"><?php echo $brand["brand_name"]; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div id="modelArea">
            <?php
            BrandModelsTemplete::generateModels($models, $status);
            ?>
        </div>


        <?php
    }

    public static function generateModels($models, $status)
    {
        if ($status == 1) {
        ?>
            <p class="ps-4 pt-4 text-lg">Model</p>
            <div class="w-[90%] ml-[5%] mt-2">
                <div class="row">
                    <select class="h-[40%]  border focus:outline-none p-3 " id="model">
                        <option value="0">Select Model</option>
                        <?php
                        $modelsArray = [];
                        while ($model = $models->fetch_assoc()) {
                            $modelsArray[] = $model;
                        }
                        foreach ($modelsArray as $model) {
                        ?>
                            <option value="<?php echo $model["model_id"]; ?>"><?php echo $model["model_name"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        <?php
        } else {
        ?>
            <p class="ps-4 pt-4 text-lg">Model</p>
            <div class="w-[90%] ml-[5%] mt-2">
                <div class="row">
                    <select class="h-[40%]  border focus:outline-none p-3 " id="model">
                        <option value="0">Select Model</option>
                        <?php
                        foreach (self::$brandsArray as $model) {
                        ?>
                            <option value="<?php echo $model["model_id"]; ?>"><?php echo $model["model_name"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
<?php
        }
    }
}
?>
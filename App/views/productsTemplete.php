<?php
class ProductsTemplete
{
    public static function generate($products, $categories, $brands, $models, $colors)
    {
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
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        </head>

        <body>
            <?php include "App/includes/header.php"; ?>
            <div class="container-fluid mb-5">
                <div class="row">

                    <div class="col-12">
                        <div class="row">

                            <!-- filter area lg -->
                            <div class="col-lg-3 d-none d-lg-block border ">
                                <div class="row">
                                    <div class="w-[90%] ml-[5%]">
                                        <div class="row">
                                            <p class="text-2xl p-3 fw-semibold">Filter Products</p>
                                            <p class="ps-4 pt-4 text-lg">Category</p>
                                            <div class="w-[90%] ml-[5%] mt-2">
                                                <div class="row">
                                                    <select class="h-[40%]  border focus:outline-none p-3 mt-1" id="category">
                                                        <option value="0">Select Category</option>
                                                        <?php
                                                        while ($category = $categories->fetch_assoc()) {
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
                                            <p class="ps-4 pt-4 text-lg">Brand</p>
                                            <div class="w-[90%] ml-[5%] mt-2">
                                                <div class="row">
                                                    <select class="h-[40%]  border focus:outline-none p-3 " id="brand">
                                                        <option value="0">Select Brand</option>
                                                        <?php
                                                        while ($brand = $brands->fetch_assoc()) {
                                                        ?>
                                                            <option value="<?php echo $brand["id"]; ?>"><?php echo $brand["brand_name"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <p class="ps-4 pt-4 text-lg">Model</p>
                                            <div class="w-[90%] ml-[5%] mt-2">
                                                <div class="row">
                                                    <select class="h-[40%]  border focus:outline-none p-3 " id="model">
                                                        <option value="0">Select Model</option>
                                                        <?php
                                                        while ($model = $models->fetch_assoc()) {
                                                        ?>
                                                            <option value="<?php echo $model["id"]; ?>"><?php echo $model["model_name"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
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
                                                    while ($color = $colors->fetch_assoc()) {
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
                            <div class="col-12 text-end p-3 d-block d-lg-none " data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i class="bi bi-funnel-fill text-[#AD1212] "></i><span class="text-[#AD1212] ps-2">Filter</span>

                                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title text-2xl p-3 fw-semibold" id="offcanvasRightLabel">Filter Products</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <div class="w-[90%] ml-[5%]">
                                            <div class="row">
                                                <p class=" pt-4 text-start text-lg">Category</p>
                                                <div class="w-[90%] ml-[5%] mt-3">
                                                    <div class="row">
                                                        <select id="category" class="h-[40%]  border focus:outline-none p-3 mt-1">
                                                            <option value="0">Select Category</option>
                                                            <?php
                                                            while ($category = $categories->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <p class="pt-4 text-start text-lg">Brand</p>
                                                <div class="w-[90%] ml-[5%] mt-3">
                                                    <div class="row">
                                                        <select id="brand" class="h-[40%]  border focus:outline-none p-3 ">
                                                            <option value="0">Select Brand</option>
                                                            <?php
                                                            while ($brand = $brands->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $brand["id"]; ?>"><?php echo $brand["brand_name"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <p class="pt-4 text-start text-lg">Model</p>
                                                <div class="w-[90%] ml-[5%] mt-3">
                                                    <div class="row">
                                                        <select id="model" class="h-[40%]  border focus:outline-none p-3 ">
                                                            <option value="0">Select Model</option>
                                                            <?php
                                                            while ($model = $models->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $model["id"]; ?>"><?php echo $model["model_name"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <p class="pt-4 text-start text-lg">Price</p>
                                                <div class="w-[90%]  ml-[5%]">
                                                    <div class="row">
                                                        <input type="text" id="minPrice" class="me-[2%] border h-[50px] w-[49%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Min">
                                                        <input type="text" id="maxPrice" class="border h-[50px] w-[49%]  p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Max">
                                                    </div>
                                                </div>
                                                <p class="pt-4 text-start text-lg">Color Family</p>
                                                <div class="w-[90%] ml-[5%] mt-3">
                                                    <div class="row">
                                                        <?php
                                                        while ($color = $colors->fetch_assoc()) {
                                                        ?>
                                                            <div data-code="<?php echo $color["id"]; ?>]" class=" color-option w-[32%] flex items-center justify-center hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
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
                                                <p class="pt-4 text-start text-lg">Rating</p>
                                                <div class="w-[90%] ml-[5%] mt-3">
                                                    <div class="row">
                                                        <?php
                                                        for ($i = 0; $i < 4; $i++) {
                                                        ?>
                                                            <div data-code="<?php echo $i; ?>" class="w-[24%] border-[#AD1212] rating-option flex items-center justify-center hover:cursor-pointer mr-[1%] p-1 mb-1 bg-[#e6e9eb] rounded text-center">
                                                                <i class="bi bi-star-fill text-yellow-500 font-semibold hover:cursor-pointer "></i>

                                                                <div class="ms-2">
                                                                    <?php echo $i; ?>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                                <p class="pt-4 text-start text-lg">Sort Products</p>
                                                <select id="sort" class="w-[90%] ml-[5%]  border h-[40%]  focus:outline-none p-3 mt-3" id="">
                                                    <option value="0">Select Sort Option</option>
                                                    <option value="1">Price Law to High</option>
                                                    <option value="2">Price Law to High</option>
                                                    <option value="3">Price Law to High</option>
                                                    <option value="4">Price Law to High</option>
                                                </select>
                                                <div>
                                                    <button onclick="clearSearch();" class="border  w-[48%]  me-[3%] rounded px-5 py-[12px] mt-4 text-[#AD1212] font-bold" style="border-color:#AD1212 ;">Clear</button>
                                                    <button onclick="filter();" class="bg-[#AD1212] w-[45%]  rounded px-5 py-[12px] mt-4 text-white font-bold">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- filter area sm -->

                            <?php
                            DisplayProductsTemplete::generate($products);
                            ?>

                        </div>
                    </div>

                </div>

            </div>
            </div>
            <?php include "App/includes/footer.php"; ?>

            <script src="assets/js/script.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="assets/plugin/bootstrap/js/bootstrap.bundle.js"></script>
        </body>

        </html>
<?php
    }
}
?>

<?php
class DisplayProductsTemplete
{
    public static function generate($products)
    {
        if (!empty($products)) {
?>
            <!-- products -->
            <div class="col-lg-9 col-12" id="products-area">
                <div class="row">
                    <?php
                    while ($product = $products->fetch_assoc()) {
                    ?>
                        <div class="col-6 col-lg-3 mb-5">
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
                                    <p class="text-md "><?php echo $product["title"]; ?></p>
                                    <p class="text-lg mt-2 fw-semibold">Rs.<?php echo $product["price"]; ?>.00</p>
                                    <div class=" mt-2">
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
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!-- products -->
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
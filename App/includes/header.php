<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <header class="overflow-hidden">
        <div class="bg-[#1D2026] lg:h-[50px] h-[30px] items-center w-full flex ">
            <div class="row">
                <ul class="d-lg-inline-flex d-none">

                    <a href="index.php" class="text-decoration-none"><li class="text-white border-t border-[#1D2026] px-5 py-1 hover:border-[#AD1212]">Home</li></a>
                    <a href="products.php" class="text-decoration-none"><li class="text-white border-t border-[#1D2026] px-5 py-1 hover:border-[#AD1212] text-white">Our Collection</li></a>
                    <a href="promotions.php" class="text-decoration-none"><li class="text-white border-t border-[#1D2026] px-5 py-1 hover:border-[#AD1212] text-white">Promotions</li></a>
                    <a href="aboutUs.php" class="text-decoration-none"><li class="text-white border-t border-[#1D2026] px-5 py-1 hover:border-[#AD1212] text-white">About Us</li></a>

                </ul>
            </div>
        </div>
        <div class="col-12 bg-white">
            <div class="row">
                <div class="col-lg-2 col-6 justify-center items-center">
                    <img src="logo/logo.png" alt="logo" width="110px" height="110px">
                </div>
                <div class="col-lg-8 d-none d-lg-flex align-items-center justify-content-center">
                    <input type="text" placeholder="What you want to search.." class="border col-8 h-[40%] p-3 focus:outline-none">
                </div>
                <div class="col-lg-2 col-6 flex justify-center items-center">
                    <a href="wishlist.php" class="text-decoration-none text-dark"><i class="bi bi-heart font-semibold mx-2 px-2  text-[24px]"></i></a>
                    <a href="cart.php" class="text-decoration-none text-dark"><i class="bi bi-cart font-semibold mx-2 px-2 text-[24px]"></i></a>
                    <a href="profile.php" class="text-decoration-none text-dark"><i class="bi bi-person font-semibold mx-2 px-2 text-[26px]"></i></a>
                </div>
                <div class="col-12 mt-1 d-flex d-lg-none justify-content-center align-items-center">
                    <input type="text" placeholder="What you want to search.." class="border col-10  p-3 focus:outline-none">
                </div>
            </div>
        </div>
    </header>

    <script>
        function ourCollection(){
            window.location = "AllCollection.php";
        }
    </script>

</body>

</html>
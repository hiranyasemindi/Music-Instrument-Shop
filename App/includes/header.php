<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>

    <header class="overflow-hidden">
        <div class="bg-[#1D2026] lg:h-[50px] h-[50px] items-center w-full flex ">
            <div class="row">
                <ul class="d-lg-inline-flex d-none">

                    <a href="index" class="text-decoration-none">
                        <li class="text-white border-t border-[#1D2026] px-5 py-1 hover:border-[#AD1212]">Home</li>
                    </a>
                    <a href="products" class="text-decoration-none">
                        <li class="text-white border-t border-[#1D2026] px-5 py-1 hover:border-[#AD1212] text-white">Our Collection</li>
                    </a>
                    <a href="promotions" class="text-decoration-none">
                        <li class="text-white border-t border-[#1D2026] px-5 py-1 hover:border-[#AD1212] text-white">Promotions</li>
                    </a>
                    <a href="aboutUs" class="text-decoration-none">
                        <li class="text-white border-t border-[#1D2026] px-5 py-1 hover:border-[#AD1212] text-white">About Us</li>
                    </a>

                </ul>
            </div>

            <div class="row d-block d-lg-none">

                <!-- drawer init and show -->
                <div class="text-center ms-3">
                    <button type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
                        <i class="bi bi-list text-white font-semibold mx-2 px-2 text-[26px]"></i>
                    </button>
                </div>

                <!-- drawer component -->
                <div id="drawer-navigation" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-64 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
                    <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu</h5>
                    <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close menu</span>
                    </button>
                    <div class="py-4 overflow-y-auto">
                        <ul class="space-y-2 font-medium">
                            <li>
                                <a href="index" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="products" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Our Collection</span>
                                </a>
                            </li>
                            <li>
                                <a href="promotions" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15 6.037c0-1.724-1.978-2.665-3.28-1.562L7.638 7.933H6c-1.105 0-2 .91-2 2.034v4.066c0 1.123.895 2.034 2 2.034h1.638l4.082 3.458c1.302 1.104 3.28.162 3.28-1.562V6.037Z" />
                                        <path fill-rule="evenodd" d="M16.786 7.658a.988.988 0 0 1 1.414-.014A6.135 6.135 0 0 1 20 12c0 1.662-.655 3.17-1.715 4.27a.989.989 0 0 1-1.414.014 1.029 1.029 0 0 1-.014-1.437A4.085 4.085 0 0 0 18 12a4.085 4.085 0 0 0-1.2-2.904 1.029 1.029 0 0 1-.014-1.438Z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Promotions</span>
                                </a>
                            </li>
                            <li>
                                <a href="aboutUs" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">About US</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-12 bg-white">
            <div class="row">
                <div class="col-lg-2 col-6 justify-center items-center">
                    <img src="logo/logo.png" alt="logo" width="110px" height="110px">
                </div>
                <div class="col-lg-8 d-none d-lg-flex align-items-center justify-content-center">

                    <input id="searchInput" type="text" placeholder="What you want to search.." class="border col-8 h-[40%] p-3 focus:outline-none">
                </div>
                <div class="col-lg-2 col-6 flex justify-center items-center">
                    <a href="wishlist" class="text-decoration-none text-dark"><i class="bi bi-heart font-semibold mx-2 px-2  text-[24px]"></i></a>
                    <a href="cart" class="text-decoration-none text-dark"><i class="bi bi-cart font-semibold mx-2 px-2 text-[24px]"></i></a>
                    <a href="purchasingHistory" class="text-decoration-none text-dark"><i class="bi bi-clock-history font-semibold mx-2 px-2 text-[24px]"></i></a>
                    <a href="profile" class="text-decoration-none text-dark"><i class="bi bi-person font-semibold mx-2 px-2 text-[26px]"></i></a>
                </div>
                <div class="col-12 mt-1 d-flex d-lg-none justify-content-center align-items-center">
                    <input id="searchInputSm" type="text" placeholder="What you want to search.." class="border col-10  p-3 focus:outline-none">
                </div>
            </div>
        </div>
    </header>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script>
        function ourCollection() {
            window.location = "AllCollection.php";
        }
    </script>

</body>

</html>
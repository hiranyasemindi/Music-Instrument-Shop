<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN LOGIN | SONORITY</title>
    <link rel="icon" href="logo//logoo.png">
    <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style=" background: linear-gradient(to left, #200122, #6f0000);">
    <div class="container-fluid  vh-100 flex items-center ">
        <div class="row  justify-center">

            <div class="col-10">
                <div class="row">
                    <div class="col-lg-6 col-12 lg:h-[690px] sm:h-[150px] bg-black">
                        <div class="row ">
                            <div class="col-10 offset-1 mt-5">
                                <div class="row">
                                    <img src="logo/logoo.png" alt="" width="200px" height="100px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 flex items-center bg-white ">
                        <div class="row">

                            <!-- signinbox -->
                            <div class="col-10 offset-1 py-5 " id="signInBox">
                                <div class="row">
                                    <p class="text-3xl text-center font-semibold">Admin Log In</p>
                                    <div class="flex items-center d-none p-4 mt-4 mb-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" id="login_alertBox" role="alert">
                                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <div id="login_alert">
                                            <span class="font-medium">Warning!</span> Change a few things up and try submitting again.
                                        </div>
                                    </div>
                                    <?php
                                    session_start();
                                    $email = "";
                                    $password = "";
                                    if (isset($_COOKIE["email"])) {
                                        $email = $_COOKIE["email"];
                                    }
                                    if (isset($_COOKIE["password"])) {
                                        $password = $_COOKIE["password"];
                                    }
                                    ?>
                                    <input type="email" class="border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="loginEmailAdmin" placeholder="Email" value="<?php echo $email; ?>">
                                    <div class="col-12   ">
                                        <div class="row  ">
                                            <input type="password" class="border-y border-l w-[85%]  h-[40%]  py-3 ps-3 focus:outline-none mt-3" id="loginPasswordAdmin" placeholder="Password" value="<?php echo $password; ?>">
                                            <div class="w-[15%] border-y border-r flex items-center justify-end  mt-3">
                                                <i class="bi bi-eye-slash-fill hover:cursor-pointer text-xl  text-[#A9A9AF] " id="icon-visibility" onclick="adminLoginVisibility();"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class=" text-end pt-1 text-[#AD1212] mt-3 hover:cursor-pointer mt-lg-0" onclick="adminForgotPassowrd();">Forgot Password?</p>
                                    <div class="flex items-center mt-3 mt-lg-0">
                                        <input class="cyberpunk-checkbox" type="checkbox" name="" id="rememberMeAdmin">
                                        <span class="ms-2  ">Remember Me</span>
                                    </div>
                                    <button class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold" onclick="adminLogIn();">Log In</button>
                                    <button class="bg-[#fff] rounded border border-[#AD1212] px-5 py-[12px] mt-4 text-[#AD1212] font-bold" onclick="window.location = 'register'">Back to User Log In</button>
                                </div>
                            </div>
                            <!-- signinbox -->

                            <!-- Main modal -->
                            <div id="fp-modal-admin" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 mt-[8%] ml-[35%] h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow ">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                                            <h3 class="text-xl font-semibold text-gray-900">
                                                Reset Your Passsword
                                            </h3>
                                            <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="fp-modal-admin">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <form class="space-y-4" action="#">
                                                <div id="fp_alertBox" class="flex items-center p-4 d-none mb-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                                    </svg>
                                                    <span class="sr-only">Info</span>
                                                    <div id="fp_alert">
                                                        <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Enter the verification Code</label>
                                                    <input type="text" id="vcodeAdmin" placeholder="****" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " required />
                                                </div>
                                                <div>
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">New password</label>
                                                    <input type="password" oninput="validateNewPasswordAdmin();" id="new_passwordAdmin" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " required />
                                                </div>
                                                <div>
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Confirm password</label>
                                                    <input type="password" id="confirm_passwordAdmin" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " required />
                                                </div>
                                                <button onclick="adminResetPassword();" type="submit" class="w-full mt-4 text-white bg-[#AD1212] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Main modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>
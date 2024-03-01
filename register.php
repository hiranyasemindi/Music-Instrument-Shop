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

<body style=" background: linear-gradient(to left, #200122, #6f0000);">
    <div class="container-fluid  vh-100 flex items-center ">
        <div class="row  justify-center">

            <div class="col-10">
                <div class="row">
                    <div class="col-lg-6 col-12 lg:h-[550px] sm:h-[150px] bg-black">
                        <div class="row ">
                            <div class="col-10 offset-1">
                                <div class="row">
                                    <img src="logo/logoo.png" alt="" width="100px" height="100px">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 flex items-center bg-white ">
                        <div class="row">

                            <!-- signinbox -->
                            <div class="col-10 offset-1 py-5 " id="signInBox">
                                <div class="row">
                                    <p class="text-3xl text-center font-semibold">Sign In</p>
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
                                    $email = "";
                                    $password = "";
                                    if (isset($_COOKIE["email"])) {
                                        $email = $_COOKIE["email"];
                                    }
                                    if (isset($_COOKIE["password"])) {
                                        $password = $_COOKIE["password"];
                                    }
                                    ?>
                                    <input type="email" class="border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="loginEmail" placeholder="Email" value="<?php echo $email; ?>">
                                    <input type="password" class="border h-[40%] p-3 mt-3 focus:outline-none" id="loginPassword" placeholder="Password" value="<?php echo $password; ?>">
                                    <p class=" text-end pt-1 text-[#AD1212] mt-3 mt-lg-0">Forgot Password?</p>
                                    <div class="flex items-center mt-3 mt-lg-0">
                                        <input class="cyberpunk-checkbox" type="checkbox" name="" id="rememberMe">
                                        <span class="ms-2  ">Remember Me</span>
                                    </div>
                                    <p class="text-center pt-3 mt-3 mt-lg-0">Don't have an account? <span class="text-blue-500 hover:cursor-pointer" onclick="changeView();">Register</span></p>
                                    <button class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold" onclick="logIn();">Log In</button>
                                </div>
                            </div>
                            <!-- signinbox -->

                            <!-- signupbox -->
                            <div class="col-10 offset-1 d-none py-5" id="signUpBox">
                                <div class="row">
                                    <p class="text-3xl text-center font-semibold">Sign Up</p>
                                    <div id="register_alertBox" class="flex d-none items-center p-4 mt-4 mb-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <div id="register_alert">
                                            <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.
                                        </div>
                                    </div>
                                    <div class="w-[49%] me-[2%]">
                                        <div class="row ">
                                            <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="fname" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="w-[49%]">
                                        <div class="row ">
                                            <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="lname" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="email" placeholder="Email">
                                    <input oninput="validatePassword();" type="password" class="border h-[40%] p-3 mt-3 focus:outline-none" id="password" placeholder="Password">
                                    <input type="password" class="border h-[40%] p-3 mt-3 focus:outline-none" id="confirmPassword" placeholder="Confirm Password">
                                    <div class="w-[49%] me-[2%]">
                                        <div class="row ">
                                            <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="mobile" placeholder="Mobile">
                                        </div>
                                    </div>
                                    <div class="w-[49%]">
                                        <div class="row ">
                                            <select class="border h-[40%]  focus:outline-none p-3 mt-3" id="gender">
                                                <option value="0">Select Gender</option>
                                                <?php
                                                require_once "libs/connection.php";
                                                $gender_rs = Database::search("SELECT * FROM `gender`;");
                                                if ($gender_rs->num_rows > 0) {
                                                    for ($i = 0; $i < $gender_rs->num_rows; $i++) {
                                                        $gender_data = $gender_rs->fetch_assoc();
                                                ?>
                                                        <option value="<?php echo $gender_data["id"]; ?>"><?php echo $gender_data["name"]; ?></option>
                                                <?php
                                                    }
                                                } else {
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <p class="text-center pt-3 mt-3 mt-lg-0">Already registered? <span class="text-blue-500 hover:cursor-pointer" onclick="changeView();">Log In</span></p>
                                    <button class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold" onclick="signUp();">Register</button>
                                </div>
                            </div>
                            <!-- signupbox -->

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <script src="assets/js/script.js"></script>
</body>

</html>
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
                    <div class="col-6 h-[550px] bg-black">
                        <div class="row ">
                            <div class="col-10 offset-1">
                                <div class="row">
                                    <img src="logo/logoo.png" alt="" width="100px" height="100px">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 flex items-center bg-white ">
                        <div class="row">

                            <!-- signinbox -->
                            <div class="col-10 offset-1 py-5 " id="signInBox">
                                <div class="row">
                                    <p class="text-3xl text-center font-semibold">Sign In</p>
                                    <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Email">
                                    <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Password">
                                    <p class="text-end pt-1 text-[#AD1212]">Forgot Password?</p>
                                    <div class="flex items-center">
                                        <input class="cyberpunk-checkbox" type="checkbox" name="" id="">
                                        <span class="ms-2">Remember Me</span>
                                    </div>
                                    <p class="text-center pt-3">Don't have an account? <span class="text-blue-500 hover:cursor-pointer" onclick="changeView();">Register</span></p>
                                    <button class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold">Log In</button>
                                </div>
                            </div>
                            <!-- signinbox -->

                            <!-- signupbox -->
                            <div class="col-10 offset-1 d-none py-5" id="signUpBox">
                                <div class="row">
                                    <p class="text-3xl text-center font-semibold">Sign Up</p>
                                    <div class="w-[49%] me-[2%]">
                                        <div class="row ">
                                            <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="w-[49%]">
                                        <div class="row ">
                                            <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Email">
                                    <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Password">
                                    <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Confirm Password">
                                    <p class="text-center pt-3">Already registered? <span class="text-blue-500 hover:cursor-pointer" onclick="changeView();">Log In</span></p>
                                    <button class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold">Register</button>
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
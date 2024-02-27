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

<body>

    <?php include "App/includes/header.php"; ?>

    <div class="container-fluid mb-5 mt-3 mt-lg-0">
        <div class="row align-items-center">

            <div class="col-lg-10 col-12 offset-0 offset-lg-1 h-[100px] " style=" background: linear-gradient(to right, #8e0e00, #1f1c18);">
                <div class="row">

                    <div class="d-none d-lg-block position-absolute mt-5 ms-[38%]">
                        <div class="rounded-circle w-[120px] h-[120px] bg-cover border border-white border-5" style="background-image: url('assets/img/round_profil_picture_before_.webp');"></div>
                    </div>

                    <div class="d-block d-lg-none position-absolute mt-5 ms-[30%]">
                        <div class="rounded-circle w-[120px] h-[120px] bg-cover border border-white border-5" style="background-image: url('assets/img/round_profil_picture_before_.webp');"></div>
                    </div>

                </div>
            </div>

            <div class="col-10 offset-1">
                <div class="row">

                    <div class="col-lg-10 col-12 offset-0 offset-lg-1 py-5 mt-4" id="signUpBox">
                        <div class="row">

                            <input type="text" class="  lg:me-[2%] border h-[40%] lg:w-[49%] sm:w-[100%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="First Name">
                            <input type="text" class="border h-[40%] lg:w-[49%] sm:w-[100%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Last Name">

                            <input type="text" class=" lg:w-[49%] sm:w-[100%] lg:me-[2%] border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Mobile Number">
                            <div class="col-12 lg:w-[49%] sm:w-[100%]  ">
                                <div class="row  ">
                                    <input type="password" class="border-y border-l w-[85%]  h-[40%]  py-3 ps-3 focus:outline-none mt-3" id="password" placeholder="Password">
                                    <div class="w-[15%] border-y border-r flex items-center justify-end  mt-3">
                                        <i class="bi bi-eye-slash-fill hover:cursor-pointer text-xl  text-[#A9A9AF] " id="icon-visibility" onclick="visibility();"></i>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Email">
                            <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Address Line 01">
                            <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Address Line 02">

                            <select class="lg:w-[32%] me-[2%] border h-[40%]  focus:outline-none p-3 mt-3" id="">
                                <option>Select City</option>
                                <option>Colombo</option>
                            </select>
                            <select class=" lg:w-[32%]  me-[2%] border h-[40%] p-3 focus:outline-none mt-3" id="">
                                <option>Select District</option>
                                <option>Colombo</option>
                            </select>
                            <select class=" lg:w-[32%]  border h-[40%] p-3 mt-3 focus:outline-none " id="">
                                <option>Select Province</option>
                                <option>Colombo</option>
                            </select>
                            <select class=" lg:w-[32%] me-[2%] border h-[40%] p-3 focus:outline-none mt-3" id="">
                                <option>Select Country</option>
                                <option>Colombo</option>
                            </select>

                            <input type="text" class="lg:w-[32%] text-[#A9A9AF] border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Postal Code">

                            <button class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php include "App/includes/footer.php"; ?>
    <script src="assets/js/script.js"></script>
</body>

</html>
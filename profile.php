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

    <div class="container-fluid mb-5">
        <div class="row align-items-center">

            <div class="col-10 bg-[#AD1212] offset-1 h-[100px] ">
                <div class="row">

                    <div class=" position-absolute mt-5 ms-[38%]">
                        <div class="rounded-circle w-[120px] h-[120px] bg-cover border border-white border-5" style="background-image: url('assets/img/round_profil_picture_before_.webp');"></div>
                    </div>

                </div>
            </div>

            <div class="col-10 offset-1">
                <div class="row">

                    <div class="col-10 offset-1 py-5 mt-4" id="signUpBox">
                        <div class="row">

                            <input type="text" class=" w-[49%] me-[2%] border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="First Name">
                            <input type="text" class="border h-[40%] w-[49%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Last Name">

                            <input type="text" class=" w-[49%] me-[2%] border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Mobile Number">
                            <input type="text" class="border h-[40%] w-[49%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="Password">

                            <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Email">
                            <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Address Line 01">
                            <input type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Address Line 02">

                            <select type="text" class="text-[#A9A9AF] w-[32%] me-[2%] border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="" placeholder="City">
                                <option>Select City</option>
                                <option>Colombo</option>
                            <select/>
                            <select type="text" class=" w-[32%] text-[#A9A9AF] me-[2%] border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="" >
                                <option>Select District</option>
                                <option>Colombo</option>
                            <select/>
                            <select type="text" class="text-[#A9A9AF] w-[32%]  border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="">
                                <option>Select Province</option>
                                <option>Colombo</option>
                            <select/>

                            <select type="text" class=" w-[32%] text-[#A9A9AF] me-[2%] border h-[40%] p-3 mt-3 focus:outline-none mt-3" id="" >
                                <option>Select Country</option>
                                <option>Colombo</option>
                            <select/>
                            <input type="text" class="w-[32%] text-[#A9A9AF] border h-[40%] p-3 mt-3 focus:outline-none" id="" placeholder="Postal Code">

                            <button class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold">Register</button>

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
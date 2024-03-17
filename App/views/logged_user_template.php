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

    <?php
    include "App/includes/header.php";

    class LoggedUserTemplate
    {
        public static function generate($user, $address, $genders, $cities, $districts, $provinces)
        {
    ?>
            <div class="container-fluid mb-5 mt-3 mt-lg-0 overflow-hidden">
                <div class="row align-items-center">
                    <div class="col-lg-10 col-12 offset-0 offset-lg-1 h-[100px] overflow-hidden" style=" background: linear-gradient(to right, #8e0e00, #1f1c18);">
                        <div class="row">
                            <!-- profile img -->
                            <div class="d-none d-lg-block position-absolute mt-5 ms-[38%] overflow-hidden">
                                <div class="rounded-circle w-[120px] h-[120px] bg-cover border border-white border-5" id="userImg" style="background-image: url('<?php echo $user["profile_img"] == null ? "assets/img/round_profil_picture_before_.png" :  $user["profile_img"]; ?>');"></div>
                                <input onchange="updateProfileImage();"  type="file" class="d-none" id="profileimg" name="profileimg" accept="image/*" />
                                <label for="profileimg"><i class="bi bi-camera-fill hover:cursor-pointer text-3xl text-dark ml-[5.3rem] absolute mt-[-3.7rem]"></i></label>
                            </div>
                            <div class="d-block d-lg-none position-absolute mt-5 ms-[30%] overflow-hidden">
                                <div class="rounded-circle w-[120px] h-[120px] bg-cover border border-white border-5" id="userImg" style="background-image: url('<?php echo $user["profile_img"] == null ? "assets/img/round_profil_picture_before_.png" :  $user["profile_img"]; ?>');"></div>
                                <input onchange="updateProfileImage();" disabled type="file" class="d-none" id="profileimg" accept="image/*" />
                                <label for="profileimg"><i class="bi bi-camera-fill hover:cursor-pointer text-3xl text-dark ml-[5.3rem] absolute mt-[-3.7rem]"></i></label>
                            </div>
                            <!-- profile img -->
                        </div>
                    </div>
                </div>
                <div class="col-10 offset-1">
                    <div class="row">
                        <div class="col-lg-10 col-12 offset-0 offset-lg-1 py-5 mt-4">
                            <div class="row">
                                <input type="text" value="<?php echo $user["fname"]; ?>" disabled class="  lg:me-[2%] border h-[40%] lg:w-[49%] sm:w-[100%] p-3 mt-3 focus:outline-none mt-3" id="fname" placeholder="First Name">
                                <input type="text" value="<?php echo $user["lname"]; ?>" disabled class="border h-[40%] lg:w-[49%] sm:w-[100%] p-3 mt-3 focus:outline-none mt-3" id="lname" placeholder="Last Name">
                                <input type="text" value="<?php echo $user["mobile"]; ?>" disabled class="  lg:me-[2%] border h-[40%] lg:w-[49%] sm:w-[100%] p-3 mt-3 focus:outline-none mt-3" id="mobile" placeholder="Mobile Number">
                                <!-- gender -->
                                <select disabled class="h-[40%] lg:w-[49%] sm:w-[100%] border focus:outline-none p-3 mt-3" id="gender">
                                    <option value="0">Select Gender</option>
                                    <?php
                                    if ($genders) {
                                        while ($gender = $genders->fetch_assoc()) {
                                            $selected = ($user["gender_name"] == $gender["gender_name"]) ? "selected" : "";
                                    ?>
                                            <option <?php echo $selected; ?> value="<?php echo $gender["id"];  ?>"><?php echo $gender["gender_name"]; ?></option>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <option disabled>No Gender available.</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- gender -->
                                <input value="<?php echo $user["email"]; ?>" disabled disabled type="text" class="border h-[40%] p-3 mt-3 focus:outline-none" id="email" placeholder="Email">
                                <input type="text" disabled class="border h-[40%] p-3 mt-3 focus:outline-none" id="line1" value="<?php echo $address ? $address["line1"] : ""; ?>" placeholder="Address Line 01">
                                <input type="text" disabled class="border h-[40%] p-3 mt-3 focus:outline-none" id="line2" value="<?php echo $address ? $address["line2"] : ""; ?>" placeholder="Address Line 02">
                                <!-- city, district, province -->
                                <select disabled class="lg:w-[32%] me-[2%] disabled border h-[40%]  focus:outline-none p-3 mt-3" id="city">
                                    <option value="0">Select City</option>
                                    <?php
                                    if ($cities) {
                                        while ($city = $cities->fetch_assoc()) {
                                            $selected = ($address["city_name"] == $city["city_name"]) ? "selected" : "";
                                    ?>
                                            <option value="<?php echo $city["id"];  ?>" <?php echo $selected; ?>><?php echo $city["city_name"]; ?></option>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <option disabled>No cities available.</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <select disabled class=" lg:w-[32%]  me-[2%] border h-[40%] p-3 focus:outline-none mt-3" id="district">
                                    <option value="0">Select District</option>
                                    <?php
                                    if ($districts) {
                                        while ($district = $districts->fetch_assoc()) {
                                            $selected = ($address["district_name"] == $district["district_name"]) ? "selected" : "";
                                    ?>
                                            <option value="<?php echo $district["id"];  ?>" <?php echo $selected; ?>><?php echo $district["district_name"]; ?></option>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <option disabled>No districts available.</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <select disabled class="lg:w-[32%]  border h-[40%] p-3 mt-3 focus:outline-none " id="province">
                                    <option value="0">Select Province</option>
                                    <?php
                                    if ($provinces) {
                                        while ($province = $provinces->fetch_assoc()) {
                                            $selected = ($address["province_name"] == $province["province_name"]) ? "selected" : "";
                                    ?>
                                            <option value="<?php echo $province["id"]; ?>" <?php echo $selected; ?>><?php echo $province["province_name"]; ?></option>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <option disabled>No provinces available.</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- city, district, province -->
                                <input type="text" value="<?php echo $user["joined_date"]; ?>" disabled class="  lg:me-[2%] border h-[40%] lg:w-[49%] sm:w-[100%] p-3 mt-3 focus:outline-none mt-3" id="joined" placeholder="Registered Date">
                                <input type="text" value="<?php echo $address ? $address["postal_code"] : ""; ?>" disabled class="border h-[40%] lg:w-[49%] sm:w-[100%] p-3 mt-3 focus:outline-none mt-3" id="postalCode" placeholder="Postal Code">
                                <button class="bg-[#AD1212] rounded px-5 py-[12px] mt-4 text-white font-bold" onclick="editProfile();" id="editBtn">Edit Profile</button>
                                <button class="bg-[#AD1212] rounded px-5 d-none py-[12px] mt-4 text-white font-bold" onclick="updateProfile();" id="updateBtn">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <?php include "App/includes/footer.php"; ?>

    <?php
        }
    }
    ?>
    <script src="assets/js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
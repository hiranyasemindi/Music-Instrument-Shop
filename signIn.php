<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AROWWAI | Sign In</title>
    <link rel="icon" href="assets/img/logo.png" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/plugin/bootstrap/css/bootstrap.css" />
</head>

<body class="vh-100 col-12" style="background-color: #FFFAEF;">

    <div class="col-12">
        <div class="justify-content-center align-items-center d-flex sign-in-main-box vh-100 col-12">
            <div class="col-11 ">

                <div class="row p-3 bg-white rounded rounded-4">
                    <div class="col-6 sign-in-hero d-none d-lg-block">
                        <div class="row">
                            <div class="col-3">
                                <img src="assets/img/logo.png" alt="logo" class="col-12">
                            </div>
                            <div class="col-9">
                                <img src="assets/img/signInHeroTop.png" alt="hearo" class="col-12"
                                    style="margin-left: 2%;">
                            </div>
                            <div class="col-12 justify-content-center d-flex" style="margin-top: -3%;">
                                <h1 style="color: #545454;">Welcome to AROWWAI!</h1>
                            </div>
                            <div class="col-12 justify-content-center d-flex" style="margin-bottom: 4%;">
                                <p class="col-7 text-center" style="color: #4B4B4B;">Enter the gateway to opulence! Sign
                                    in
                                    to indulge in the allure of our finely crafted jewelry</p>
                            </div>
                            <div class="col-12 justify-content-center d-flex mt-5">
                                <img src="assets/img/signInParts.png" alt="signInParts" style="width: 60%;">
                            </div>
                        </div>
                    </div>
                    <!-- Sign In start  -->
                    <div class="col-lg-6 col-12 d-none" id="signUpBox">
                        <div class="row">
                            <div>
                                <h1 class="fw-bold mt-1 text-center">Get Started</h1>
                                <div class="text-center">
                                    <span style="font-size: 0.9rem; color: #4B4B4B;">Already have
                                        account?</span>&nbsp;<span class="sign-in-link" onclick="changeView();">Sign In</span>
                                </div>
                            </div>

                            <div class="col-12 d-flex align-items-center justify-content-center sign-in-text-field-area">
                                <div class="row p-3 col-12">
                                    <div class="col-lg-6 col-12 mb-lg-0 mb-5">
                                        <span class="sign-in-input-label">First Name</span>
                                        <input type="text" class="col-12 sign-in-input">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <span class="sign-in-input-label">Last Name</span>
                                        <input type="text" class="col-12 sign-in-input">
                                    </div>
                                    <div class="col-12 mt-5 mb-5">
                                        <span class="sign-in-input-label">Email</span>
                                        <input type="email" class="col-12 sign-in-input">
                                    </div>
                                    <div class="col-lg-6 col-12 mb-lg-0 mb-5">
                                        <span class="sign-in-input-label">Password</span>
                                        <input type="password" class="col-12 sign-in-input">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <span class="sign-in-input-label mb-2">Gender</span>
                                        <select name="" id="" class="col-12 sign-in-input" style="padding: 5.5px;">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-12 justify-content-center d-flex mt-5">
                                        <button class="btn col-lg-4 col-5 fw-bold p-2"
                                            style="background-color: #E7B94E; color: #FFFAEF; font-size: 0.8rem;">Sign
                                            In</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Sign up start  -->


                    <!-- Sign In Start -->
                    <div class="col-lg-6 col-12" id="signInBox">
                        <div class="row">
                            <div>
                                <h1 class="fw-bold mt-1 text-center">Get Started</h1>
                                <div class="text-center">
                                    <span style="font-size: 0.9rem; color: #4B4B4B;">Create new
                                        account</span>&nbsp;<span class="sign-in-link" onclick="changeView();">Sign Up</span>
                                </div>
                            </div>

                            <div class="col-12 d-flex align-items-center justify-content-center sign-in-text-field-area">
                                <div class="row p-lg-3 p-0 col-12">
                                    <div class="col-12">
                                        <span class="sign-in-input-label">Email</span>
                                        <input type="email" class="col-12 sign-in-input">
                                    </div>
                                    <div class="col-12 mt-5 mb-3">
                                        <span class="sign-in-input-label">Password</span>
                                        <input type="password" class="col-12 sign-in-input">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label class="cyberpunk-checkbox-label">
                                            <input type="checkbox" class="cyberpunk-checkbox">
                                            Remember Me</label>
                                    </div>
                                    <div class="col-6 mb-2 d-flex justify-content-end">
                                        <label class="sign-in-FP">Forgotten Password ?</label>
                                    </div>
                                    <div class="col-12 justify-content-center d-flex mt-5 mb-3">
                                        <button class="btn col-lg-4 col-5 fw-bold p-2"
                                            style="background-color: #E7B94E; color: #FFFAEF; font-size: 0.8rem;">Sign
                                            Up</button>
                                    </div>
                                    <div class="col-lg-5 col-4"><hr></div>
                                    <div class="col-lg-2 col-4 d-flex align-items-center fw-semibold" style="font-size: 0.7rem; color: #898989;">Or sign up with</div>
                                    <div class="col-lg-5 col-4"><hr></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Sign Up End -->

                </div>


            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end align-items-start sign-in-ellipse-right col-12 vh-100">
        <div class="col-3">
            <img src="assets/img/EllipseRight.png" alt="topEllipes" class="col-12">
        </div>
    </div>

    <div class="d-flex justify-content-start align-items-end sign-in-ellipse-left col-12 vh-100">
        <div class="col-3">
            <img src="assets/img/EllipseLeft.png" alt="topEllipes" class="col-12 ">
        </div>
    </div>

    <script src="assets/js/script.js"></script>

</body>

</html>
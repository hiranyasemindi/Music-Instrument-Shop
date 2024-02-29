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

<body style="background: linear-gradient(to right, #200122, #6f0000);">

    <?php include "App/includes/header.php"; ?>

    <div class="container-fluid mb-5">
        <div class="row">

            <div class="col-12 ">
                <div class="row">


                    <div class="col-lg-8 col-12 my-5 offset-lg-2 col-md-10 py-4 offset-md-1 bg-white rounded mb-5 mb-lg-3">
                        <div class="row">

                            <div class="col-12 col-md-10  offset-md-1">
                                <div class="row">

                                    <div class="col-12 col-md-8 offset-md-4 col-lg-6 py-2 offset-lg-6 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-1 ">
                                                <button class="btn btn-success col-12  d-flex justify-content-center align-items-center">
                                                    <ion-icon class="text-light me-1" name="print-outline"></ion-icon>
                                                    Print
                                                </button>
                                            </div>
                                            <div class="col-12 col-md-6 mb-1">
                                                <button class="btn btn-danger col-12 d-flex justify-content-center align-items-center">
                                                    <ion-icon class="text-light me-1" name="document-outline"></ion-icon>
                                                    Export as PDF
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 border-bottom border-top border-dark mt-2">
                                        <h2 class="form-label fw-semibold mt-2">Invoice</h2>
                                    </div>
                                    <div class="col-12 border-bottom border-dark">
                                        <div class="row">
                                            <div class="col-4 col-lg-6 mt-3">
                                                <h5 class="text-[#AD1212] fw-semibold mb-2">Sonority</h5>
                                                <label class="form-label text-secondary">222/C, Main Rd,
                                                    Pallawatte</label><br />
                                                <label class="form-label text-secondary">Colombo</label><br />
                                                <label class="form-label text-secondary">+94 71 445 4095 / +94 112 702
                                                    106</label><br />
                                                <label class="form-label text-secondary">sonority@gmail.com</label><br />
                                            </div>
                                            <div class="col-8 col-lg-6 text-end mt-3">
                                                <label class="form-label fw-semibold">Bill To : </label><br />
                                                <label class="form-label">Amal Bandara</label><br />
                                                <label class="form-label text-secondary">174/6, Gemunu Mawatha,
                                                    Welmilla</label><br />
                                                <label class="form-label text-secondary">Kalutara</label><br />
                                                <label class="form-label text-secondary">amalbandara@gmail.com</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 border-bottom border-dark">
                                        <div class="row">
                                            <div class="col-6 mt-3">
                                                <h5 class="text-dark">Invoice #</h5>
                                                <label class="form-label text-secondary">0002</label><br />

                                                <label class="form-label text-dark">Date & Time</label><br />
                                                <label class="form-label text-secondary">2023-01-06 & 01.00 p.m</label><br />
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="row">

                                            <div class="col-12 p-2 bg-secondary my-1  bg-opacity-10">
                                                <div class="row">
                                                    <div class="col-1 ">
                                                        <label class="form-label">#</label>
                                                    </div>
                                                    <div class="col-4 ">
                                                        <label class="form-label">Order No & Item</label>
                                                    </div>
                                                    <div class="col-2 ">
                                                        <label class="form-label">Unit price</label>
                                                    </div>
                                                    <div class="col-2 ">
                                                        <label class="form-label">Quantity</label>
                                                    </div>
                                                    <div class="col-3 text-end">
                                                        <label class="form-label">Amount</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-2 border-bottom border-secondary border-opacity-25">
                                                <div class="row">
                                                    <div class="col-1 ">
                                                        <label class="form-label">01</label>
                                                    </div>
                                                    <div class="col-4 ">
                                                        <label class="form-label">0001 </label><br />
                                                        <label class="form-label fw-semibold ">Samsung Galaxy S9</label>
                                                    </div>
                                                    <div class="col-2 d-flex align-items-center">
                                                        <label class="form-label">Rs.59,454.00</label>
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                                        <label class="form-label">1</label>
                                                    </div>
                                                    <div class="col-3 d-flex align-items-center justify-content-end">
                                                        <label class="form-label ">Rs.59,454.00</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-2 border-bottom border-secondary border-opacity-25">
                                                <div class="row">
                                                    <div class="col-1 ">
                                                        <label class="form-label">02</label>
                                                    </div>
                                                    <div class="col-4 ">
                                                        <label class="form-label">0003 </label><br />
                                                        <label class="form-label fw-semibold ">Single Battery Charger AC</label>
                                                    </div>
                                                    <div class="col-2 d-flex align-items-center">
                                                        <label class="form-label">Rs.380.00</label>
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                                        <label class="form-label">3</label>
                                                    </div>
                                                    <div class="col-3 d-flex align-items-center justify-content-end">
                                                        <label class="form-label">Rs.1,140.00</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-2 border-bottom border-dark">
                                                <div class="row">
                                                    <div class="col-1 ">
                                                        <label class="form-label">03</label>
                                                    </div>
                                                    <div class="col-4 ">
                                                        <label class="form-label">0004 </label><br />
                                                        <label class="form-label fw-semibold ">1 Channel Relay Module</label>
                                                    </div>
                                                    <div class="col-2 d-flex align-items-center">
                                                        <label class="form-label">Rs.245.00</label>
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                                        <label class="form-label">5</label>
                                                    </div>
                                                    <div class="col-3 d-flex align-items-center justify-content-end">
                                                        <label class="form-label">Rs.1,225.00</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12  mt-2">
                                                <div class="row">

                                                    <div class="col-4 col-lg-6 d-flex justify-content-center align-items-center mt-2">
                                                        <h3 class="text-[#AD1212] fw-semibold text-xl">Thank You!</h3>
                                                    </div>

                                                    <div class="col-8 col-lg-6 mt-2 border-bottom border-dark mb-3">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <label class="form-label">Sub Total</label>
                                                            </div>
                                                            <div class="col-7 d-flex justify-content-end">
                                                                <label class="form-label">Rs.61,819.00</label>
                                                            </div>
                                                            <div class="col-5">
                                                                <label class="form-label">Delivery Charges</label>
                                                            </div>
                                                            <div class="col-7 d-flex justify-content-end">
                                                                <label class="form-label">Rs.00.00</label>
                                                            </div>
                                                            <div class="col-5 mt-2 border-top border-bottom mb-1 border-dark">
                                                                <label class="form-label mt-2">Grand Total</label>
                                                            </div>
                                                            <div class="col-7 mt-2 border-top border-dark border-bottom mb-1 d-flex justify-content-end">
                                                                <label class="form-label mt-2 fw-bolder">Rs.61,819.00</label>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </div>
                                            </div>






                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
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
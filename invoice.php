<?php
require_once "libs/connection.php";
$process = new Process();
$process->handleRequest();
class Process
{

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->handleGETRequest();
        } else {
            include "404.php";
        }
    }

    private function handleGETRequest()
    {
        if (isset($_GET["data"])) {
            $invoiceArrayJSON = $_GET['data'];
            $invoiceDataArray = json_decode(urldecode($invoiceArrayJSON), true);
            InvoiceTemplete::generate($invoiceDataArray);
        } else {
            include "404.php";
        }
    }
}

?>

<?php
class InvoiceTemplete
{
    public static function generate($invoiceDataArray)
    {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Invoice | SONORITY</title>
            <link rel="icon" href="logo//logoo.png">
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
                                                    <div class="col-6 offset-6 mb-1 ">
                                                        <button onclick="printInvoice();" class="btn bg-[#AD1212] col-12 text-white d-flex justify-content-center align-items-center">
                                                            <ion-icon class="text-light me-1" name="print-outline"></ion-icon>
                                                            Print or Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12" id="printArea">
                                                <div class="row">
                                                    <div class="col-12 border-bottom border-top border-dark mt-2">
                                                        <h2 class="form-label fw-semibold mt-2">Invoice</h2>
                                                    </div>
                                                    <div class="col-12 border-bottom border-dark">
                                                        <div class="row">
                                                            <div class="col-4 col-lg-6 mt-3">
                                                                <h5 class="text-[#AD1212] fw-semibold mb-2">Sonority</h5>
                                                                <label class="form-label text-secondary">222/C, Main Rd,
                                                                    Piliyandala</label><br />
                                                                <label class="form-label text-secondary">Colombo</label><br />
                                                                <label class="form-label text-secondary">+94 71 445 4095 / +94 112 702
                                                                    106</label><br />
                                                                <label class="form-label text-secondary">contact@sonority.com</label><br />
                                                            </div>
                                                            <div class="col-8 col-lg-6 text-end mt-3">
                                                                <label class="form-label fw-semibold">Bill To : </label><br />
                                                                <label class="form-label"><?php echo $invoiceDataArray["name"]; ?></label><br />
                                                                <label class="form-label text-secondary"><?php echo $invoiceDataArray["address"]; ?></label><br />
                                                                <label class="form-label text-secondary"><?php echo $invoiceDataArray["district"]; ?></label><br />
                                                                <label class="form-label text-secondary"><?php echo $invoiceDataArray["email"]; ?></label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 border-bottom border-dark">
                                                        <div class="row">
                                                            <div class="col-6 mt-3">
                                                                <h5 class="text-dark">Invoice #</h5>
                                                                <label class="form-label text-secondary"><?php echo $invoiceDataArray["invoice_id"]; ?></label><br />

                                                                <label class="form-label text-dark">Date & Time</label><br />
                                                                <label class="form-label text-secondary"><?php echo $invoiceDataArray["date"]; ?></label><br />
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
                                                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                                                        <label class="form-label">Quantity</label>
                                                                    </div>
                                                                    <div class="col-3 text-end">
                                                                        <label class="form-label">Amount</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <?php
                                                            foreach ($invoiceDataArray["productArray"] as $product) {
                                                            ?>
                                                                <div class="col-12 mt-2 border-bottom border-secondary border-opacity-25">
                                                                    <div class="row">
                                                                        <div class="col-1 py-3">
                                                                            <label class="form-label"><?php echo $product['id'] ?></label>
                                                                        </div>
                                                                        <div class="col-4 py-3">
                                                                            <label class="form-label fw-semibold "><?php echo $product['item'] ?></label>
                                                                        </div>
                                                                        <div class="col-2 d-flex align-items-center">
                                                                            <label class="form-label">Rs.<?php echo $product['price'] ?>.00</label>
                                                                        </div>
                                                                        <div class="col-2 d-flex justify-content-center align-items-center">
                                                                            <label class="form-label"><?php echo $product['quantity'] ?></label>
                                                                        </div>
                                                                        <div class="col-3 d-flex align-items-center justify-content-end">
                                                                            <label class="form-label ">Rs.<?php echo $product['amount'] ?>.00</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>

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
                                                                                <label class="form-label">Rs.<?php echo $invoiceDataArray["subtotal"]; ?>.00</label>
                                                                            </div>
                                                                            <div class="col-5">
                                                                                <label class="form-label">Delivery Charges</label>
                                                                            </div>
                                                                            <div class="col-7 d-flex justify-content-end">
                                                                                <label class="form-label">Rs.<?php echo $invoiceDataArray["shipping"]; ?>.00</label>
                                                                            </div>
                                                                            <div class="col-5 mt-2 border-top border-bottom mb-1 border-dark">
                                                                                <label class="form-label mt-2">Grand Total</label>
                                                                            </div>
                                                                            <div class="col-7 mt-2 border-top border-dark border-bottom mb-1 d-flex justify-content-end">
                                                                                <label class="form-label mt-2 fw-bolder">Rs.<?php echo $invoiceDataArray["total"]; ?>.00</label>
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

            </div>
            </div>

            <?php include "App/includes/footer.php"; ?>
            <script src="assets/js/script.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
        </body>

        </html>

<?php
    }
}
?>
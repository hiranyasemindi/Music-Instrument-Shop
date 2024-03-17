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
    include "App/includes/header.php"; ?>
    <div class="flex items-center justify-center">
        <img src="assets/img/undraw_secure_login_pdn4.svg" alt="loginImg" width="500px" height="500px">
    </div>
    <div class="flex items-center justify-center mt-4">
        <span class="fw-semibold text-3xl">Please Login To Your Account First</span>
    </div>
    <div class="flex items-center justify-center mt-4">
        <button onclick="window.location.href = 'register.php'" class="bg-[#AD1212] rounded px-5 py-[12px] mt-1 my-5 text-white font-bold">Login</button>
    </div>


    <?php include "App/includes/footer.php"; ?>

    <script src="assets/js/script.js"></script>
</body>

</html>
<?php
class AdminHeaderTemplete
{
    public static function generate()
    {
?>
        <!-- header -->
        <div class="row">
            <div class=" h-[5rem] col-2 items-center pe-3 flex">
                <span class="ps-2 font-medium text-lg">Hello <?php echo $_SESSION["admin"]["name"]; ?>, <br><span class="text-xl fw-semibold"><?php echo $_SESSION["admin"]["email"]; ?></span></span>
            </div>
            <div class=" h-[5rem] col-2 offset-8 items-center pe-3 flex justify-end" onclick="profile();">
                <img class="hover:cursor-pointer" src="<?php echo $_SESSION["admin"]["profile_img"]; ?>" width="65rem" alt="">
            </div>
        </div>
        <!-- header -->

        <script>
            function profile() {
                localStorage.setItem("activeMenuItem", "");
                window.location.href = 'adminProfile'
            }
        </script>
<?php
    }
}
?>
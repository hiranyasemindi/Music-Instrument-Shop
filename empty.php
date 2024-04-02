<?php
class EmptyDesign
{
    public static function generate($text)
    {
?>
        <div class="col-12 ">
            <div class="flex items-center justify-center">
                <img src="assets/img/undraw_no_data_re_kwbl.svg" alt="loginImg" width="500px" height="500px">
            </div>
            <div class="flex items-center justify-center mt-4">
                <span class="fw-semibold text-3xl"><?php echo $text; ?></span>
            </div>
            <div class="flex items-center justify-center mt-4">
                <button onclick="window.location.href = 'index'" class="bg-[#AD1212] rounded px-5 py-[12px] mt-1 my-5 text-white font-bold">Go to Home</button>
            </div>
        </div>
<?php
    }
}
?>
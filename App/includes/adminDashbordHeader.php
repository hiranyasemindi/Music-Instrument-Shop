 <!-- header -->
 <div class="row">
     <div class=" h-[5rem] col-2 items-center pe-3 flex">
         <span class="ps-2 font-medium text-lg">Hello Admin, <br><span class="text-xl fw-semibold">Hiranya Semindi</span></span>
     </div>
     <div class=" h-[5rem] col-2 offset-8 items-center pe-3 flex justify-end" onclick="profile();">
         <img class="hover:cursor-pointer" src="assets//img//profile_images/Hiranya_65f6eb3def49b.png" width="65rem" alt="">
     </div>
 </div>
 <!-- header -->

 <script>
    function profile(){
        localStorage.setItem("activeMenuItem", "");
        window.location.href = 'adminProfile'
    }
 </script>
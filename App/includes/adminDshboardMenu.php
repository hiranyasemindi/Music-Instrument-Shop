 <!-- Left area  -->
 <div class="lg:w-[18%] bg-[#1D2026] vh-100">
     <div class="row">
         <div class="col-10 offset-1 h-[10%]">
             <div class="row">
                 <img src="logo/logoo.png" alt="" width="100px" height="50px">
             </div>
         </div>
         <div class="col-10 offset-1 h-[31rem]">
             <div class="row">
                 <div onclick="changeBgColor('adminDashboard');"  id="adminDashboard" class="text-start  p-[13px] rounded-1 hover:cursor-pointer item">
                     <i class="bi bi-columns-gap mx-4 text-lg text-white"></i><span class="text-white">Dashboard</span>
                 </div>
                 <div  onclick="changeBgColor('adminManageUsers');" id="adminManageUsers" class="text-start  mt-3 p-[13px] rounded-1 hover:cursor-pointer item">
                     <i class="bi bi-people mx-4 text-lg text-white"></i><span class="text-white">Manage Users</span>
                 </div>
                 <div onclick="changeBgColor('adminManageProducts');" id="adminManageProducts" class="text-start  mt-3 p-[13px] rounded-1 hover:cursor-pointer item">
                     <i class="bi bi-box-seam mx-4 text-lg text-white"></i><span class="text-white">Manage Products</span>
                 </div>
                 <div onclick="changeBgColor('adminOrders');" id="adminOrders" class="text-start  mt-3 p-[13px] rounded-1 hover:cursor-pointer item">
                     <i class="bi bi-list-task mx-4 text-lg text-white"></i><span class="text-white">Orders</span>
                 </div>
                 <div onclick="changeBgColor('adminPromotions');" id="adminPromotions" class="text-start  mt-3 p-[13px] rounded-1 hover:cursor-pointer item">
                     <i class="bi bi-megaphone mx-4 text-lg text-white"></i><span class="text-white">Promotions</span>
                 </div>
             </div>
         </div>
         <div class="col-10 offset-1 h-[10%]">
             <div class="row">
                 <div class="text-start mt-3 p-[13px] rounded-1 hover:cursor-pointer">
                     <i class="bi bi-box-arrow-right mx-4 text-lg text-white"></i><span class="text-white">Logout</span>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Left area  -->
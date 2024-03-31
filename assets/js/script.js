function changeView() {
  $("#signUpBox").toggleClass("d-none");
  $("#signInBox").toggleClass("d-none");
}

function visibility() {
  var pw = document.getElementById("password");
  var iv = document.getElementById("icon-visibility");

  if (pw.type == "password") {
    pw.type = "text";
    iv.className =
      "bi bi-eye-fill hover:cursor-pointer text-xl  text-[#A9A9AF] ";
  } else {
    pw.type = "password";
    iv.className =
      "bi bi-eye-slash-fill hover:cursor-pointer text-xl   text-[#A9A9AF] ";
  }
}

function signUp() {
  var fname = $("#fname").val();
  var lname = $("#lname").val();
  var email = $("#email").val();
  var password = $("#password").val();
  var confirmPassword = $("#confirmPassword").val();
  var mobile = $("#mobile").val();
  var gender = $("#gender").val();

  var emailRegex =
    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var mobileRegex = /^07[1245678]{1}[0-9]{7}$/;

  var registerAlertBox = $("#register_alertBox");
  var registerAlert = $("#register_alert");

  if (fname == "") {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Please Enter Your First Name.");
  } else if (lname == "") {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Please Enter Your Last Name.");
  } else if (email == "") {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Please Enter Your Email Address.");
  } else if (!email.match(emailRegex)) {
    registerAlertBox.removeClass("d-none");
    document.getElementById("register_alert").innerHTML =
      "Please Enter a Valid Email Address.";
  } else if (password == "") {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Please Enter Your Password.");
  } else if (confirmPassword == "") {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Please Re-Type Your Password.");
  } else if (password !== confirmPassword) {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Password Doesn't Match.");
  } else if (mobile == "") {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Please Enter Your Mobile.");
  } else if (!mobile.match(mobileRegex)) {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Please Enter a Valid Mobile Number.");
  } else if (gender == 0) {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Please Select Your Gender.");
  } else {
    registerAlertBox.addClass("d-none");
    fetch("api/signUpProcess.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        fname: fname,
        lname: lname,
        email: email,
        password: password,
        mobile: mobile,
        gender: gender,
      }),
    })
      .then((response) => response.text())
      .then((data) => {
        var res = JSON.parse(data);
        if (res.msg == "Successfully Regitered.") {
          alert(res.msg);
          $("#signUpBox").toggleClass("d-none");
          $("#signInBox").toggleClass("d-none");
        } else {
          alert(res.error);
        }
      })
      .catch((error) => {
        console.log("error: " + error);
      });
  }
}

function validatePassword() {
  var password = $("#password").val();
  var pattern1 = /[a-z]/;
  var pattern2 = /[A-Z]/;
  var pattern3 = /[0-9]/;
  var pattern4 = /.{8,}/;

  var registerAlertBox = $("#register_alertBox");
  var registerAlert = $("#register_alert");

  if (!password.match(pattern1)) {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Password Must Contain Lowercase Letters.");
  } else if (!password.match(pattern2)) {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Password Must Contain Uppercase Letters.");
  } else if (!password.match(pattern3)) {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Password Must Contain Digits.");
  } else if (!password.match(pattern4)) {
    registerAlertBox.removeClass("d-none");
    registerAlert.text("Password Must Contain Minimum 8 Charactors.");
  } else {
    registerAlertBox.addClass("d-none");
  }
}

function logIn() {
  var email = $("#loginEmail").val();
  var password = $("#loginPassword").val();
  var rememberMe = $("#rememberMe").prop("checked");

  var emailRegex =
    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var loginAlertBox = $("#login_alertBox");
  var loginAlert = $("#login_alert");

  if (email == "") {
    loginAlertBox.removeClass("d-none");
    loginAlert.text("Please Enter Your Email Address.");
  } else if (!email.match(emailRegex)) {
    loginAlertBox.removeClass("d-none");
    loginAlert.text("Please Enter a Valid Email Address.");
  } else if (password == "") {
    loginAlertBox.removeClass("d-none");
    loginAlert.text("Please Enter Your Password.");
  } else {
    loginAlertBox.addClass("d-none");
    fetch("api/signInProcess.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        email: email,
        password: password,
        rememberMe: rememberMe == true ? "true" : "false",
      }),
    })
      .then((response) => response.text())
      .then((data) => {
        var res = JSON.parse(data);
        if (res.msg == "SignIn Success.") {
          loginAlertBox.addClass("d-none");
          // alert(res.done);
          window.location = "index.php";
        } else {
          loginAlertBox.removeClass("d-none");
          loginAlert.text(res.error);
        }
      });
  }
}

function loginVisibility() {
  var pw = $("#loginPassword");
  var iv = $("#icon-visibility");

  if (pw.attr("type") == "password") {
    pw.attr("type", "text");
    iv.attr(
      "class",
      "bi bi-eye-fill hover:cursor-pointer text-xl  text-[#A9A9AF] "
    );
  } else {
    pw.attr("type", "password");
    iv.attr(
      "class",
      "bi bi-eye-slash-fill hover:cursor-pointer text-xl   text-[#A9A9AF] "
    );
  }
}

function registerVisibility() {
  var pw = $("#password");
  var iv = $("#icon-visibility2");

  if (pw.attr("type") == "password") {
    pw.attr("type", "text");
    iv.attr(
      "class",
      "bi bi-eye-fill hover:cursor-pointer text-xl  text-[#A9A9AF] "
    );
  } else {
    pw.attr("type", "password");
    iv.attr(
      "class",
      "bi bi-eye-slash-fill hover:cursor-pointer text-xl  text-[#A9A9AF] "
    );
  }
}

function registerConfirmVisibility() {
  var cpw = $("#confirmPassword");
  var iv = $("#icon-visibility3");

  if (cpw.attr("type") == "password") {
    cpw.attr("type", "text");
    iv.attr(
      "class",
      "bi bi-eye-fill hover:cursor-pointer text-xl  text-[#A9A9AF] "
    );
  } else {
    cpw.attr("type", "password");
    iv.attr(
      "class",
      "bi bi-eye-slash-fill hover:cursor-pointer text-xl  text-[#A9A9AF] "
    );
  }
}

var model;
function forgotPassowrd() {
  var email = $("#loginEmail").val();

  var emailRegex =
    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  var loginAlertBox = $("#login_alertBox");
  var loginAlert = $("#login_alert");

  if (email == "") {
    loginAlertBox.removeClass("d-none");
    loginAlert.text("Please Enter Your Email Address.");
  } else if (!email.match(emailRegex)) {
    loginAlertBox.removeClass("d-none");
    loginAlert.text("Please Enter a Valid Email Address.");
  } else {
    loginAlertBox.addClass("d-none");
    fetch("api/forgotPasswordProcess.php?email=" + email, {
      method: "GET",
    })
      .then((response) => response.text())
      .then((data) => {
        var res = JSON.parse(data);
        if (res.msg == "openModel") {
          model = $("#fp-modal");
          model.removeClass("hidden").attr("aria-hidden", "false").focus();
          $('[data-modal-hide="fp-modal"]').on("click", function () {
            model.addClass("hidden").attr("aria-hidden", "true");
          });
        } else {
          alert(res.error);
        }
      })
      .catch((error) => {
        console.log("error: " + error);
      });
  }
}

function resetPassword() {
  var vcode = $("#vcode").val();
  var npw = $("#new_password").val();
  var cpw = $("#confirm_password").val();
  var email = $("#loginEmail").val();

  var fpAlertBox = $("#fp_alertBox");
  var fpAlert = $("#fp_alert");

  if (npw == "") {
    fpAlertBox.removeClass("d-none");
    fpAlert.text("Please fill the new password field.");
  } else if (cpw == "") {
    fpAlertBox.removeClass("d-none");
    fpAlert.text("Please re-type your password.");
  } else if (npw !== cpw) {
    fpAlertBox.removeClass("d-none");
    fpAlert.text("Password doesn't match.");
  } else {
    fpAlertBox.addClass("d-none");
    fetch("api/forgotPasswordProcess.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        vcode: vcode,
        npw: npw,
        email: email,
      }),
    })
      .then((response) => response.text())
      .then((data) => {
        var res = JSON.parse(data);
        if ((res.msg = "Reset Success.")) {
          alert(res.msg);
          model.addClass("hidden");
          $("#vcode").val("");
          $("#new_password").val("");
          $("#confirm_password").val("");
          // $("#loginEmail").val("");
        } else {
          alert(res.error);
        }
      })
      .catch((error) => {
        console.log("error: " + error);
      });
  }
}

function validateNewPassword() {
  var password = $("#new_password").val();
  var pattern1 = /[a-z]/;
  var pattern2 = /[A-Z]/;
  var pattern3 = /[0-9]/;
  var pattern4 = /.{8,}/;

  var fpAlertBox = $("#fp_alertBox");
  var fpAlert = $("#fp_alert");

  if (!password.match(pattern1)) {
    fpAlertBox.removeClass("d-none");
    fpAlert.text("Password Must Contain Lowercase Letters.");
  } else if (!password.match(pattern2)) {
    fpAlertBox.removeClass("d-none");
    fpAlert.text("Password Must Contain Uppercase Letters.");
  } else if (!password.match(pattern3)) {
    fpAlertBox.removeClass("d-none");
    fpAlert.text("Password Must Contain Digits.");
  } else if (!password.match(pattern4)) {
    fpAlertBox.removeClass("d-none");
    fpAlert.text("Password Must Contain Minimum 8 Characters.");
  } else {
    fpAlertBox.addClass("d-none");
  }
}

function editProfile() {
  $("#profileimg").removeAttr("disabled");
  $("#fname").removeAttr("disabled");
  $("#lname").removeAttr("disabled");
  $("#line1").removeAttr("disabled");
  $("#line2").removeAttr("disabled");
  $("#city").removeAttr("disabled");
  $("#district").removeAttr("disabled");
  $("#province").removeAttr("disabled");
  $("#postalCode").removeAttr("disabled");
  $("#editBtn").toggleClass("d-none");
  $("#updateBtn").toggleClass("d-none");
  alert("Now You Can Edit Your Profile Details");
}

function updateProfile() {
  var fname = $("#fname").val();
  var lname = $("#lname").val();
  var line1 = $("#line1").val();
  var line2 = $("#line2").val();
  var city = $("#city").val();
  var postalCode = $("#postalCode").val();
  console.log(fname, lname, line1, line2, city, district, province, postalCode);
  fetch("api/updateProfile.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      fname: fname,
      lname: lname,
      line1: line1,
      line2: line2,
      city: city,
      postalCode: postalCode,
    }),
  })
    .then((response) => response.text())
    .then((data) => {
      var response = JSON.parse(data);
      if (
        response.msg == "Update Success." ||
        response.msg == "Insert Success."
      ) {
        alert("Succesfully Updated.");
        window.location.reload();
      } else {
        alert(response.error);
      }
    })
    .catch((error) => {
      console.log("error: " + error);
    });
}

function updateProfileImage() {
  var img = $("#userImg");

  var fileInput = $("#profileimg");
  var file = fileInput[0].files[0];

  var form = new FormData();
  form.append("img", file);
  console.log(form.get("img"));
  fetch("api/updateProfileImage.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.text())
    .then((data) => {
      var response = JSON.parse(data);
      if (response.msg == "Successfully Updated") {
        alert("Succesfully Updated.");
        window.location.reload();
      } else {
        alert(response.error);
      }
    })
    .catch((error) => {
      console.log("error: " + error);
    });
}

function selectDistrictProvince() {
  var cityId = $("#city").val();
  fetch("api/getDistrictsandProvinces.php?id=" + cityId, {
    method: "GET",
  })
    .then((response) => response.text())
    .then((data) => {
      var response = JSON.parse(data);
      if (response.msg == "Success") {
        var district_id = response.district_id;
        var district_name = response.district_name;
        var province_id = response.province_id;
        var province_name = response.province_name;
        var districtSelect = $("#district");
        districtSelect.empty();
        districtSelect.append(
          $("<option>").text("Select District").attr("value", "0")
        );
        districtSelect.append(
          $("<option>")
            .text(district_name)
            .attr("value", district_id)
            .attr("selected", true)
        );
        var provinceSelect = $("#province");
        provinceSelect.empty();
        provinceSelect.append(
          $("<option>").text("Select Province").attr("value", "0")
        );
        provinceSelect.append(
          $("<option>")
            .text(province_name)
            .attr("value", province_id)
            .attr("selected", true)
        );
      } else {
        alert(response.error);
      }
    })
    .catch((error) => {
      console.log("error: " + error);
    });
}

function addToWishlist(id) {
  fetch("api/addToCartAndWishlist.php?function=wishlist&id=" + id, {
    method: "GET",
  })
    .then((response) => response.text())
    .then((data) => {
      var response = JSON.parse(data);
      response.msg ? alert(response.msg) : alert(response.error);
      window.location.reload();
    })
    .catch((error) => {
      console.log("Error: " + error);
    });
}

function addToCart(id) {
  fetch("api/addToCartAndWishlist.php?function=cart&id=" + id, {
    method: "GET",
  })
    .then((response) => response.text())
    .then((data) => {
      var response = JSON.parse(data);
      response.msg ? alert(response.msg) : alert(response.error);
      window.location.reload();
    })
    .catch((error) => {
      console.log("Error: " + error);
    });
}

function deleteFromWishlist(id) {
  fetch("api/deleteFromCartAndWishlist.php?function=wishlist&id=" + id, {
    method: "GET",
  })
    .then((response) => response.text())
    .then((data) => {
      var response = JSON.parse(data);
      response.msg ? alert(response.msg) : alert(response.error);
      window.location.reload();
    })
    .catch((error) => {
      console.log("Error: " + error);
    });
}

function deleteFromCart(id) {
  fetch("api/deleteFromCartAndWishlist.php?function=cart&id=" + id, {
    method: "GET",
  })
    .then((response) => response.text())
    .then((data) => {
      var response = JSON.parse(data);
      response.msg ? alert(response.msg) : alert(response.error);
      window.location.reload();
    })
    .catch((error) => {
      console.log("Error: " + error);
    });
}
7;
function incrementQty(prodcut_qty, cart_id, price) {
  var qty = $("#qty" + cart_id + "").text();
  var newQty = parseInt(qty) + 1;
  prodcut_qty >= newQty
    ? $("#qty" + cart_id + "").text(newQty)
    : alert("Only " + prodcut_qty + " Items are Available.");
  var subtotal = parseInt(price) * parseInt($("#qty" + cart_id).text());
  $("#price" + cart_id).text(subtotal);

  var checkeBox = $("#cartCheck" + cart_id);
  var status = checkeBox.prop("checked") ? "checked" : "unchecked";
  if (status == "checked") {
    $("#subtotal").text(subtotal);
    $("#total").text(parseInt(subtotal) + parseInt($("#shipping").text()));
  }
}

function decrementQty(cart_id, price) {
  var qty = $("#qty" + cart_id + "").text();

  var newQty = parseInt(qty) - 1;
  newQty >= 1
    ? $("#qty" + cart_id + "").text(newQty)
    : alert("Only " + prodcut_qty + " Items are Available.");
  var total = parseInt(price) * parseInt($("#qty" + cart_id).text());
  $("#price" + cart_id).text(total);

  var checkeBox = $("#cartCheck" + cart_id);
  var status = checkeBox.prop("checked") ? "checked" : "unchecked";
  if (status == "checked") {
    $("#subtotal").text(subtotal);
    $("#total").text(parseInt(subtotal) + parseInt($("#shipping").text()));
  }
}

var items;
var subtotal;
var shipping;
var total;

function updateCartSummary(cart_id) {
  items = parseInt($("#items").text());
  subtotal = parseInt($("#subtotal").text());
  shipping = parseInt($("#shipping").text());
  total = parseInt($("#total").text());

  var price = $("#price" + cart_id).text();
  var df = $("#df" + cart_id).text();
  var checkeBox = $("#cartCheck" + cart_id);
  var status = checkeBox.prop("checked") ? "checked" : "unchecked";

  if (status == "checked") {
    checkedProcess(price, df);
    setSummaryInfo();
  } else {
    uncheckedProcess(price, df);
    setSummaryInfo();
  }
}

function checkedProcess(price, df) {
  items += 1;
  subtotal += parseInt(price);
  shipping += parseInt(df);
  total += shipping + subtotal;
}

function uncheckedProcess(price, df) {
  items -= 1;
  subtotal -= parseInt(price);
  shipping -= parseInt(df);
  total = subtotal + shipping;
}

function setSummaryInfo() {
  $("#items").text(items);
  $("#subtotal").text(subtotal);
  $("#shipping").text(shipping);
  $("#total").text(total);
}

function checkQty(maxQty, event) {
  var typedQty = parseInt(event.target.value);

  if (typedQty > maxQty) {
    alert("Typed quantity exceeds the maximum quantity.");
    $("#requiredQty").val(maxQty);
  }

  if (typedQty < 0) {
    $("#requiredQty").val(0);
    return;
  }
}


function checkout() {
  var productArray = [];

  document.querySelectorAll(".product").forEach(function (productElement) {
    var isChecked = productElement.querySelector(".cyberpunk-checkbox").checked;

    if (isChecked) {
      var id = productElement.dataset.productId;
      var title = productElement.querySelector(".product-title").textContent;
      var price = parseFloat(
        productElement
          .querySelector(".product-price")
          .textContent.replace(/[^0-9.-]+/g, "")
      );
      var delivery = parseFloat(
        productElement
          .querySelector(".delivery-price")
          .textContent.replace(/[^0-9.-]+/g, "")
      );
      var quantity = parseInt(
        productElement.querySelector(".product-quantity").textContent
      );
      var condition =
        productElement.querySelector(".product-condition").textContent;
      var availableQty =
        productElement.querySelector(".product-available").textContent;
      var image = productElement.querySelector(".product-image").src;

      var product = {
        id: id,
        title: title,
        price: price,
        quantity: quantity,
        delivery_fee: delivery,
        condition: condition,
        image: image,
        availableQty: availableQty,
      };

      productArray.push(product);
    }
    console.log(productArray);
  });
  console.log(productArray);
  var productArrayJSON = JSON.stringify(productArray);

  var encodedProductArray = encodeURIComponent(productArrayJSON);

  window.location =
    "checkout.php?email=" +
    encodeURIComponent($("#umail").text()) +
    "&array=" +
    encodedProductArray;
}

function buyNow(product_id, condition, df, availableQty) {
  var qty = $("#requiredQty").val();
  if (qty == "") {
    alert("Please Insert the Qty");
  }
  var array = [];
  var product = {
    id: product_id,
    title: $("#title").text(),
    price: parseInt($("#price").text()) * parseInt(qty),
    quantity: qty,
    delivery_fee: df,
    condition: condition,
    image: $("#product-image").attr("src"),
    availableQty: availableQty,
  };
  array.push(product);
  console.log(array);
  parray = array;
  var productArrayJSON = JSON.stringify(parray);

  var encodedProductArray = encodeURIComponent(productArrayJSON);

  window.location =
    "checkout.php?email=" +
    encodeURIComponent($("#spumail").text()) +
    "&array=" +
    encodedProductArray;
}

function confirmOrder(title, total, parray) {
  console.log(parray)
  var productArray = JSON.parse(parray);
  fetch("api/confirmOrderProcess.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      title: title,
      total: total,
    }),
  })
    .then((response) => response.text())
    .then((data) => {
      // alert(data);
      var response = JSON.parse(data);
      if (response.msg == "Success") {
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);
          // Note: validate the payment and show success or failure page to the customer
          saveInvoice(
            response.requiredData.order_id,
            response.requiredData.amount,
            productArray
          );
        };
        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          window.location = "404.php";
          console.log("Payment dismissed");
        };
        // Error occurred
        payhere.onError = function onError(error) {
          window.location = "404.php";
          console.log("Error:" + error);
        };
        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: response.requiredData.merchant_id,
          return_url: "http://localhost/music_shop/index.php",
          cancel_url: "http://localhost/music_shop/index.php",
          notify_url: "http://sample.com/notify",
          order_id: response.requiredData.order_id,
          items: response.requiredData.item,
          amount: response.requiredData.amount,
          currency: response.requiredData.currency,
          hash: response.requiredData.hash,
          first_name: response.requiredData.fname,
          last_name: response.requiredData.lname,
          email: response.requiredData.email,
          phone: response.requiredData.mobile,
          address: response.requiredData.address,
          city: response.requiredData.city,
          country: "Sri Lanka",
          delivery_address: response.requiredData.address,
          delivery_city: response.requiredData.city,
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };
        // Show the payhere.js popup, when "PayHere Pay" is clicked
        document.getElementById("payhere-payment").onclick = function (e) {
          payhere.startPayment(payment);
        };
      } else {
        alert(response.error);
      }
    })
    .catch((error) => {
      console.log("Error: " + error);
    });
}

function saveInvoice(order_id, amount, productArray) {
  console.log(productArray);
  fetch("api/saveInvoice.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      productArray: productArray,
      orderId: order_id,
      amount: amount,
      subtotal: $("#cSubtotle").text(),
      shipping: $("#cShipping").text(),
    }),
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(data);
      var response = JSON.parse(data);
      if (response.msg == "Success") {
        var invoiceDataArrayJSON = JSON.stringify(response.invoiceData);
        var encodedInvoiceDataArray = encodeURIComponent(invoiceDataArrayJSON);
        window.location = "invoice.php?data=" + encodedInvoiceDataArray;
      } else {
        alert(response.error);
      }
    })
    .catch((error) => {
      console.log("Error: " + error);
    });
}

var selectedColorId;
var selectedRating;
document.addEventListener("DOMContentLoaded", function () {
  const colorOptions = document.querySelectorAll(".color-option");
  const ratingOptions = document.querySelectorAll(".rating-option");
  const paymentOptions = document.querySelectorAll(".payment-option");

  colorOptions.forEach(function (option) {
    option.addEventListener("click", function () {
      colorOptions.forEach(function (opt) {
        opt.classList.remove("border-[1px]");
      });
      option.classList.add("border-[1px]");
      selectedColorId = option.getAttribute("data-code");
    });
  });
  ratingOptions.forEach(function (option) {
    option.addEventListener("click", function () {
      ratingOptions.forEach(function (opt) {
        opt.classList.remove("border-[1px]");
      });
      option.classList.add("border-[1px]");
      selectedRating = option.getAttribute("data-code");
    });
  });
  paymentOptions.forEach(function (option) {
    option.addEventListener("click", function () {
      paymentOptions.forEach(function (opt) {
        opt.classList.remove("border-[1px]");
      });
      option.classList.add("border-[1px]");
      selectedPatyment = option.getAttribute("data-code");
    });
  });
});

function filter() {
  var category = $("#category").val();
  var brand = $("#brand").val();
  var model = $("#model").val();
  var min = $("#minPrice").val();
  var max = $("#maxPrice").val();
  var sort = $("#sort").val();
  console.log(
    JSON.stringify({
      category: category,
      brand: brand,
      model: model,
      min: parseInt(min),
      max: parseInt(max),
      color: selectedColorId,
      rating: selectedRating,
      sort: sort,
    })
  );
  fetch("api/filterProcess.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      category: category,
      brand: brand,
      model: model,
      min: parseInt(min),
      max: parseInt(max),
      color: selectedColorId ? selectedColorId : null,
      rating: selectedRating ? selectedRating : null,
      sort: sort,
    }),
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(data);
      if (data.trim() === "error") {
        window.location = "404.php";
      } else {
        $("#products-area").html(data);
      }
    })
    .catch((error) => {
      console.log("Error: " + error);
    });
}

function clearSearch() {
  window.location = "products";
}

function loadProductsByCategories(id) {
  fetch("api/productsByCategory.php?id=" + id, {
    method: "GET",
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(data);
      window.location = "productsByCategory.php";
    })
    .catch((error) => {
      console.log("Error: " + error);
    });
}

function printInvoice() {
  var printContent = $("#printArea").html();
  var originalContent = $("body").html();

  $("body").html(printContent);
  window.print();
  $("body").html(originalContent);
}

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
        if (res.done == "Successfully Regitered.") {
          alert(res.done);
          $("#signUpBox").toggleClass("d-none");
          $("#signInBox").toggleClass("d-none");
        } else {
          alert(res.error);
        }
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
        if (res.done == "SignIn Success.") {
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
          $("#loginEmail").val("");
        } else {
          alert(res.error);
        }
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

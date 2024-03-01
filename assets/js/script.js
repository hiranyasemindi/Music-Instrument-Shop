// Sign In change view start
function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}
// Sign In change view end

//single prodct view toggle
function toggle() {
  var descriptionArea = document.getElementById("descriptionArea");
  var additionalInfoArea = document.getElementById("additionalInfoArea");

  descriptionArea.classList.toggle("d-none");
  additionalInfoArea.classList.toggle("d-none");

  if (descriptionArea.classList.contains("d-none")) {
    document.getElementById("descriptionBtn").style.backgroundColor = "#F0DCAC";
    document.getElementById("additionalinfonBtn").style.backgroundColor = ""; // Reset background color
  } else {
    document.getElementById("descriptionBtn").style.backgroundColor = "";
    document.getElementById("additionalinfonBtn").style.backgroundColor =
      "#F0DCAC";
  }
}
//single prodct view toggle

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
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmPassword").value;
  var mobile = document.getElementById("mobile").value;
  var gender = document.getElementById("gender").value;

  var emailRegex =
    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var mobileRegex = /^07[1245678]{1}[0-9]{7}$/;

  if (fname == "") {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Please Enter Your First Name.";
  } else if (lname == "") {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Please Enter Your Last Name.";
  } else if (email == "") {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Please Enter Your Email Address.";
  } else if (!email.match(emailRegex)) {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Please Enter a Valid Email Address.";
  } else if (password == "") {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Please Enter Your Password.";
  } else if (confirmPassword == "") {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Please Re-Type Your Password.";
  } else if (password !== confirmPassword) {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Password Doesn't Match.";
  } else if (mobile == "") {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Please Enter Your Mobile.";
  } else if (!mobile.match(mobileRegex)) {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Please Enter a Valid Mobile Number.";
  } else if (gender == 0) {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Please Select Your Gender.";
  } else {
    document.getElementById("register_alertBox").classList.add("d-none");
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
        } else {
          alert(res.error);
        }
      });
  }
}

function validatePassword() {
  var password = document.getElementById("password").value;
  var pattern1 = /[a-z]/;
  var pattern2 = /[A-Z]/;
  var pattern3 = /[0-9]/;
  var pattern4 = /.{8,}/;
  if (!password.match(pattern1)) {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Password Must Contain Lowercase Letters.";
  } else if (!password.match(pattern2)) {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Password Must Contain Uppercase Letters.";
  } else if (!password.match(pattern3)) {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Password Must Contain Digits.";
  } else if (!password.match(pattern4)) {
    document.getElementById("register_alertBox").classList.remove("d-none");
    document.getElementById("register_alert").innerHTML =
      "Password Must Contain Minimum 8 Charactors.";
  } else {
    document.getElementById("register_alertBox").classList.add("d-none");
  }
}

function logIn() {
  var email = document.getElementById("loginEmail").value;
  var password = document.getElementById("loginPassword").value;
  var rememberMe = document.getElementById("rememberMe").checked;

  var emailRegex =
    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (email == "") {
    document.getElementById("login_alertBox").classList.remove("d-none");
    document.getElementById("login_alert").innerHTML =
      "Please Enter Your Email Address.";
  } else if (!email.match(emailRegex)) {
    document.getElementById("login_alertBox").classList.remove("d-none");
    document.getElementById("login_alert").innerHTML =
      "Please Enter a Valid Email Address.";
  } else if (password == "") {
    document.getElementById("login_alertBox").classList.remove("d-none");
    document.getElementById("login_alert").innerHTML =
      "Please Enter Your Password.";
  } else {
    document.getElementById("login_alertBox").classList.add("d-none");
    fetch("api/signInProcess.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        email: email,
        password: password,
        rememberMe: rememberMe,
      }),
    })
      .then((response) => response.text())
      .then((data) => {
        var res = JSON.parse(data);
        if (res.done == "SignIn Success.") {
          alert(res.done);
        } else {
          alert(res.error);
        }
      });
  }
}

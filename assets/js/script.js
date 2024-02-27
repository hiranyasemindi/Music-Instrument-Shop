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
    iv.className = "bi bi-eye-fill hover:cursor-pointer text-xl  text-[#A9A9AF] ";
  }else{
    pw.type = "password";
    iv.className = "bi bi-eye-slash-fill hover:cursor-pointer text-xl   text-[#A9A9AF] ";
  }
}

function validateAndSignIn() {
  validateLogin();
}

function validateLogin() {
  let emailField = document.getElementById("login");
  let email = emailField.value;
  let hint = document.getElementById("login-hint");

  let fieldBorderColor = "#C70039";

  emailField.style.borderColor = "";
  hint.innerText = "";

  if (!email) {
    hint.innerText = "Enter youre email";
    emailField.style.borderColor = fieldBorderColor;
  } else if (!validateEmail(email)) {
    hint.innerText = "Please provide a valid email address.";
    emailField.style.borderColor = fieldBorderColor;
  }
}

function valdiatePassword() {
  let password = document.getElementById("password").value;
}

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function isOriginalEmail(email) {
  let xhr = new XMLHttpRequest();
}
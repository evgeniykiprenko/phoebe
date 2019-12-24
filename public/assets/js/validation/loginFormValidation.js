function validateAndSignIn() {
  if (validateLogin() && valdiatePassword()) {
    signIn();
  }
}

const fieldBorderColor = "#C70039";

function validateLogin() {
  let emailField = document.getElementById("login");
  let email = emailField.value;
  let hint = document.getElementById("login-hint");

  hint.innerText = "";

  function isValidEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }

  if (!email) {
    hint.innerText = "Enter youre email.";
    return;
  } else if (!isValidEmail(email)) {
    hint.innerText = "Provide a valid email address.";
    return;
  }

  return true;
}

function valdiatePassword() {
  let passwordField = document.getElementById("pwd");
  let password = passwordField.value;
  let hint = document.getElementById('pwd-hint');

  passwordField.style.borderColor = "initial";
  hint.innerText = "";

  if (!password) {
    hint.innerText = 'Enter your password.';
    return;
  }

  return true;
}

function signIn() {
  let email = document.getElementById("login").value;
  let password = document.getElementById("pwd").value;

  let xhr = new XMLHttpRequest();

  var params = 'email=' + email + '&password=' + password;

  xhr.onload = () => {
    if (xhr.status == 200) {
      let response = xhr.responseText;
      if (response === 'incorrect') {
        let hint = document.getElementById('pwd-hint');
        hint.innerText = 'Incorrect login or password.';
      } else if (response === 'success') {
        window.location.reload(true);
      }
    }
  }

  xhr.open("POST", '/UI-Controllers/authController.php', true);

  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.send(params);
}
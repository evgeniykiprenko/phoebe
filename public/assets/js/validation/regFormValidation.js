function validateAndSignUp() {
    if (validateFirstName() && validateLastName() && validateRegLogin() && valdiateRegPassword()) {
        signUp();
    }
}


function validateRegLogin() {

    let emailField = document.getElementById("reg-login");
    let email = emailField.value;
    let hint = document.getElementById("reg-login-hint");

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

function valdiateRegPassword() {
    let passwordField = document.getElementById("reg-pwd");
    let password = passwordField.value;
    let hint = document.getElementById('reg-pwd-hint');

    passwordField.style.borderColor = "initial";
    hint.innerText = "";

    if (!password) {
        hint.innerText = 'Enter your password.';
        return;
    }

    return true;
}

function validateName(name) {
    return /^[a-zA-Z]+$/.test(name);
}

function validateFirstName() {
    let firstNameField = document.getElementById("first_name");
    let firstName = firstNameField.value;
    let hint = document.getElementById('reg-first-name-hint');

    firstNameField.style.borderColor = "initial";
    hint.innerText = "";

    if (!validateName(firstName)) {
        hint.innerText = 'Provide a valid first name';
        return;
    }

    return true;
}

function validateLastName() {
    let lastNameField = document.getElementById("last_name");
    let lastName = lastNameField.value;
    let hint = document.getElementById('reg-last-name-hint');

    lastNameField.style.borderColor = "initial";
    hint.innerText = "";

    if (!validateName(lastName)) {
        hint.innerText = 'Provide a valid last name';
        return;
    }

    return true;
}

// function isOriginalEmail(email) {
//   return new Promise((resolve, reject) => {
//     let xhr = new XMLHttpRequest();

//     xhr.open("POST", '/phoebe/controllers/emailOriginalityCheckController.php', true);

//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

//     xhr.onload = () => {
//       if (xhr.status == 200) {
//         if (xhr.responseText === 'true') {
//           resolve();
//         }
//         reject()
//       }
//     }

//     xhr.send('email=' + email);
//   });
// }

//At least 8 characters, 1 digit and 1 uppercase letter.
// function isValidPassword(password) {
//   let re = /^(?=.*\d)(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
//   return re.test(password);
// }

function signUp() {
    let email = document.getElementById("reg-login").value;
    let password = document.getElementById("reg-pwd").value;
    let firstName = document.getElementById("first_name").value;
    let lastName = document.getElementById("last_name").value;

    let xhr = new XMLHttpRequest();

    var params = 'email=' + email + '&password=' + password + '&firstName=' + firstName + '&lastName=' + lastName;

    xhr.onload = () => {
        if (xhr.status == 200) {
            let response = xhr.responseText;
            if (response === 'invalidData') {
                let hint = document.getElementById('reg-pwd-hint');
                hint.innerText = 'There is an error, please, try again, please:)';
            } else if (response === 'notOriginalEmail') { success
                let hint = document.getElementById('reg-pwd-hint');
                hint.innerText = 'Youre email is already in use. Login using it.';
            } else if (response === 'success') {
                window.location.reload(true);
            }
        }
    }

    xhr.open("POST", '/phoebe/controllers/registrationController.php', true);

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send(params);
}
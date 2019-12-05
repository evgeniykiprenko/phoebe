function validateLogin() {
    let loginField = document.getElementById('login');
    let login = loginField.value;
    let hint = document.getElementById('login_hint');

    let allowedSymbols = '^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$';
    let fieldBorderColor = '#C70039';

    loginField.style.borderColor = '';
    hint.innerText = '';
    
    if (!login) {
        hint.innerText = 'The field is requried.';
        loginField.style.borderColor = fieldBorderColor;
    } else if (!login.match(allowedSymbols)) {
        hint.innerText = 'Please provide a valid email address.';
        loginField.style.borderColor = fieldBorderColor;
    } 
}

function valdiatePassword() {
    let password = document.getElementById('password').value;
}
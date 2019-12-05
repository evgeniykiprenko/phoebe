function validateLogin() {
    //Very pretty red color #C70039 
    let loginField = document.getElementById('login');
    let login = loginField.value;
    let hint = document.getElementById('login_hint')
    
    if (!login) {
        hint.style.display = 'block';
        hint.innerText = 'The field is requried.';
        hint.style.borderColor = '#C70039';
    }
}

function valdiatePassword() {
    let password = document.getElementById('password').value;
}
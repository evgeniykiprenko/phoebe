function signIn(email, password) {
    return new Promise((resolve, reject) => {
        let params = 'email=' + email + '&password=' + password;
        let url = '/phoebe/controllers/emailOriginalityCheckController.php'

        xhr.open("POST", url, true);

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = () => {
            if (xhr.status == 200) {
                if (xhr.responseText === 'incorrect') {
                    resolve();
                }
                reject();
            }
        }

        xhr.send(params);
    });
}
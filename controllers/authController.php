<?php
include 'validationUtils.php';
include 'dbUtils.php';

session_start();

$mainPage = '../public/index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['incorrect'] = false;
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (isValid($email) && isValid($password)) {
        $sql = "SELECT * FROM users WHERE email = '" . trim($email) . "';";
        $result = runQuery($sql);
        if ($result->num_rows > 0 && $result['password'] == $password) {
            $_SESSION['auth'] = true;
            $_SESSION['firstName'] = $result['first_name'];
            $_SESSION['lastName'] = $result['last_name'];
            $_SESSION['email'] = $email['email'];
            if ($result['role_id'] == '1') {
                $_SESSION['email'] = 'admin';
            } else {
                $_SESSION['email'] = 'user';
            }
        }
    } else {
        $_SESSION['incorrect'] = true;
    }
}

header('Location: ' . $mainPage);


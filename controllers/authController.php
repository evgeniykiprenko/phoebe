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
        $sql = "SELECT * FROM users WHERE email = '" . $email . "';";
        $result = runQuery($sql);
        if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['firstName'] = $row['first_name'];
            $_SESSION['lastName'] = $row['last_name'];
            $_SESSION['email'] = $row['email'];
            if ($row['role_id'] == '1') {
                $_SESSION['role'] = 'admin';
            } else {
                $_SESSION['role'] = 'user';
            }
        }
    } else {
        $_SESSION['incorrect'] = true;
    }
}

header('Location: ' . $mainPage);


<?php
include 'utils/dbUtils.php';
include 'utils/validationUtils.php';

session_start();

$mainPage = "/phoebe/public/index.php";

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location:" . $mainPage);
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    if (isValid($email) && isValid($password) && isValid($firstName) && isValid($lastName)) {
        if (!checkEmailOriginality($email)) {
            echo 'notOriginalEmail';
            exit;
        }
        $addUserSql = "INSERT INTO users (first_name, last_name, email, password)
            VALUES ('" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $password . "');";
        runQuery($addUserSql);
        $getId = "SELECT id FROM users WHERE email = '$email';";
        $result = runQuery($getId);
        if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = 'user';
            echo 'success';
            exit;
        }
    }
}
echo 'invalidData';
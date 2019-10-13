<?php
include 'validationUtils.php';
include 'dbUtils.php';

session_start();

$mainPage = "../public/index.php";

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location:" . $mainPage);
} else {
    //getting user data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    $registrationPage = "../public/templates/registrationPage.php";

    if (isValid($email) && isValid($password) && isValid($firstName) && isValid($lastName)) {
        $addUserSql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $password . "');";
        runQuery($addUserSql);
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'user';
        header("Location:" . $mainPage);
    } else {
        header("Location:" . $registrationPage);
    }
}
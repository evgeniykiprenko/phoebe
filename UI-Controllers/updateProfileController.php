<?php
include 'utils/validationUtils.php';
include 'utils/dbUtils.php';

session_start();

$profilePage = "/public/templates/profile.php";

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location: $profilePage?id=$id");
} else {
    //getting user data
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];


    if (isValid($email) && isValid($password) && isValid($firstName) && isValid($lastName)) {
        $addUserSql = "UPDATE users SET email = '$email', password = '$password', first_name = '$firstName', last_name = '$lastName' WHERE id = $id;";
        runQuery($addUserSql);
    }
    header("Location: $profilePage?id=$id");
}
<?php
session_start();

/**
 * Function for validation user parameters
 * @param $data
 * @return string
 */
function isValid($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return empty($data);
}

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

    if (isValid($email) || isValid($password) || isValid($firstName) || isValid($lastName)) {
        header("Location:" . $registrationPage);
    } else {

        $servername = "localhost";
        $dbUser = "root";
        $dbPassword = "root";
        $database = "phoebe";

        $conn = new mysqli($servername, $dbUser, $dbPassword, $database);
        if ($conn->connect_error) {
            //this is a temporary solution, just to prevent showing details of our DB
            die('Oops, something went wrong! Try again, please.');
        }

        $addUserSql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $password . "');";
        $conn->query($addUserSql);
    }
}
<?php

function runQuery($sql) {
    $servername = "localhost";
    $dbUser = "root";
    $dbPassword = "root";
    $database = "phoebe";
    $conn = new mysqli($servername, $dbUser, $dbPassword, $database);
    if ($conn->connect_error) {
        return null;
    }
    $result = $conn->query($sql);
    mysqli_close($conn);
    return $result;
}

function checkEmailOriginality($email) {
    $sql = "SELECT id FROM users WHERE email = '$email';";
    return runQuery($sql)->num_rows == 0;
}

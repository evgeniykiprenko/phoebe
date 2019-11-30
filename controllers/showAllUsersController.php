<?php

 include "utils/dbUtils.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $sql = "SELECT users.id, users.first_name, users.last_name, users.email, users.role_id FROM users;";
    $users = mysqli_fetch_all(runQuery($sql), MYSQLI_ASSOC);

    echo json_encode($users);
}


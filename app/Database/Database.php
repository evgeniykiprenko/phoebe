<?php

namespace app\Database;
//This file loads env variables.
require('./env.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Database
{
    public static function runQuery($sql)
    {
        $conn = new \mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
        if ($conn->connect_error) {
            return null;
        }
        $result = $conn->query($sql);
        mysqli_close($conn);
        return $result;
    }

    public static function checkEmailOriginality($email) {
        $sql = "SELECT id FROM users WHERE email = '$email';";
        return self::runQuery($sql)->num_rows == 0;
    }
}

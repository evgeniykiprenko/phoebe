<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Database
{
    private static $servername = "localhost";
    private static $dbUser = "root";
    private static $dbPassword = "root";
    private static $database = "phoebe";

    public static function getConnection()
    {
        return new mysqli(self::$servername, self::$dbUser, self::$dbPassword, self::$database);
    }

    public static function closeConnection($conn)
    {
        mysqli_close($conn);
    }

    public static function runQuery($sql)
    {
        $conn = new mysqli(self::$servername, self::$dbUser, self::$dbPassword, self::$database);
        if ($conn->connect_error) {
            return null;
        }
        $result = $conn->query($sql);
        mysqli_close($conn);
        return $result;
    }
}

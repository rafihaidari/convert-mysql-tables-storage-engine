<?php
function conn($db, $user, $pwd)
{

    try {
        $dbhost = 'localhost';
        $database = $db;
        $dbuser = $user;
        $dbpass = $pwd;

        $conn = new PDO("mysql:host=$dbhost;dbname=$database", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        return false;
    }
}

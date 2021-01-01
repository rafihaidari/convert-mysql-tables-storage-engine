<?php
require_once('config.php');
session_start();

class CheckConn
{

    function checkConnection($db, $usr, $pwd)
    {
        return conn($db, $usr, $pwd);
    }
}

if (class_exists('CheckConn')) {
    if (isset($_POST['dbName'])) {

        $db = $_POST['dbName'];
        $user = $_POST['dbUser'];
        $password = $_POST['dbPassword'];

        $checkCon = new CheckConn();
        $conn = $checkCon->checkConnection($db, $user, $password);

        $errMessage = '';
        $arr = [];

        if ($conn === false) {
            $errMessage = '<div class="alert alert-dismissible fade show alert-danger" role="alert" data-color="danger">
    <strong>Uh oh!</strong> Could not connect to the database!
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>';
            $arr['alert'] = $errMessage;
        } else {
            $errMessage = '<div class="alert alert-dismissible fade show alert-success" role="alert" data-color="success">
    <strong>Woo hoo!</strong> Connected Succeffuly!
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>';

            $stmt = $conn->prepare("
            select TABLE_NAME, ENGINE from information_schema.TABLES where TABLE_SCHEMA='$db'
    ");
            $stmt->execute();
            $res = $stmt->fetchAll();

            $_SESSION['login'] =  true;

            $_SESSION['dbName'] = $db;
            $_SESSION['dbUser'] = $user;
            $_SESSION['dbPassword'] = $password;

            $arr['alert'] = $errMessage;
            $arr['tablesInfo'] = $res;
        }

        echo json_encode($arr);
    }
}

<?php
require_once('checkConn.php');
class ConvertStorageEngine
{
    function convertAllTablesEngine($from, $to)
    {
        if (isset($_SESSION['dbName'])) {
            $db = $_SESSION['dbName'];
            $user = $_SESSION['dbUser'];
            $password = $_SESSION['dbPassword'];
            $checkCon = new CheckConn();
            $pdo = $checkCon->checkConnection($db, $user, $password);

            $alertMessage = '';
            $arr = [];

            $results = $pdo->query("show tables;");
            $i = 0;
            while ($row = $results->fetch()) {
                $sql = "SHOW TABLE STATUS WHERE Name = '{$row['Tables_in_' .$db]}'";
                $thisTable = $pdo->query($sql)->fetch();
                if ($thisTable['Engine'] === $from) {
                    $sql = "alter table " . $row['Tables_in_' . $db] . " ENGINE =" . $to . ";";
                    $alertMessage = "<tr class='bg-success'><td>$i</td><td>{$row['Tables_in_' .$db]}</td><td> Converted  from {$thisTable['Engine']} to $to.</td></tr>";
                    $arr[$i] = $alertMessage;

                    $pdo->query($sql);
                } else {
                    $alertMessage = "<tr class='bg-warning'><td>$i</td><td>" . $row['Tables_in_' . $db] . '</td><td> Engine Type is ' . $thisTable['Engine'] . ' nothing changed!</td></tr>';

                    $arr[$i] = $alertMessage;
                }
                $i++;
            }
        }
        echo json_encode($arr);
    }
}

if (class_exists('ConvertStorageEngine')) {
    if (isset($_SESSION['login']) &&  $_SESSION['login'] === true && isset($_POST['from'])) {
        $from = $_POST['from'];
        $to = $_POST['to'];
        $convert = new ConvertStorageEngine();
        $convert->convertAllTablesEngine($from, $to);
    }
}

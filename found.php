<?php

    $stPlace = $_POST['stPlace'];
    $endPlace = $_POST['endPlace'];


    $db_host='localhost';
    $db_name='users';
    $db_user='root';
    $db_pass='';
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $mysqli->set_charset("utf8mb4");

    $result = $mysqli->query("SELECT * FROM `train_list` WHERE `startPlace` = '$stPlace' AND `endPlace` = '$endPlace'");

    $mysqli->close();

    $trainId = $result->fetch_assoc();
    if(count($trainId) != 0) {
        setcookie('train-id', $trainId['id'], time() + 3600, "/");
    }

    header ('Location: list.php');
?>

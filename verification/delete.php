<?php
    $db_host='localhost';
    $db_name='users';
    $db_user='root';
    $db_pass='';
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $mysqli->set_charset("utf8mb4");

    setcookie('user', $user['id'], time() - 3600, "/");

    $user = $_COOKIE['user'];
    $result = $mysqli->query("DELETE FROM `users_list` WHERE `id` = '$user' ");


    $mysqli->close();

    header('Location: /');
?>

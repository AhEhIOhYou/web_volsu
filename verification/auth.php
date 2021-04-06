<?php

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $pass = md5($pass."lolItsGettingHard");

    $db_host='localhost';
    $db_name='users';
    $db_user='root';
    $db_pass='';
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

    $result = $mysqli->query("SELECT * FROM `users_list`
                            WHERE `email` = '$login' OR `login` = '$login'
                            AND `pass` = '$pass'");
    $user = $result->fetch_assoc();
    if(count($user) == 0) {
        echo "Пользователя не существует";
        exit();
    }

    session_start();
    setcookie('user', $user['id'], time() + 3600, "/");


    $mysqli->close();

    header('Location: /');

?>

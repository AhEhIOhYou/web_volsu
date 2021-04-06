<?php

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $pass = md5($pass."lolItsGettingHard");


    try {
        $db = new PDO('mysql:host=localhost;dbname=users', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    $usedata = $db->query("SELECT `id` FROM `users_list`
                        WHERE `email` = '$login' OR `login` = '$login'
                        AND `pass` = '$pass'");

    $user_id = $usedata->fetchColumn();

    if($user_id == null) {
        echo "Пользователя не существует!";
    } else {
        session_start();
        $_SESSION['user'] = $user_id;
    }


    header('Location: /');
 
?>

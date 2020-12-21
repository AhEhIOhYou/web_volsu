<?php

    $login = $_POST['login'];
    $pass = $_POST['pass'];


    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    $usedata = $db->prepare("SELECT `id` FROM `users_data`
                        WHERE `login` = ?
                        AND `pass` = ?");
    $usedata->execute([$login, $pass]);

    $user_id = $usedata->fetchColumn();

    $type = $db->prepare("SELECT `user_type` FROM `users_data` WHERE `id` = ?");
    $type->execute([$user_id]);
    $user_type = $type->fetchColumn();

    session_start();

    if ($user_type == 2) {
        $_SESSION['admin'] = true;
    } else {
        $_SESSION['admin'] = false;
    }

    if($user_id == null) {
        echo "Пользователя не существует!";
        die();
    } else {
        $_SESSION['user'] = $user_id;
    }


    header('Location: /index.php');
 
?>

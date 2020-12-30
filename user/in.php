<?php

    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $pass = md5($pass."lolItsGettingHard");

    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    //находим нужные данные
    $usedata = $db->prepare("SELECT `id` FROM `users_data`
                        WHERE `login` = ?
                        AND `pass` = ?");
    $usedata->execute([$login, $pass]);

    //проверяем тип пользователя
    $user_id = $usedata->fetchColumn();
    $type = $db->prepare("SELECT `user_type` FROM `users_data` WHERE `id` = ?");
    $type->execute([$user_id]);
    $user_type = $type->fetchColumn();

    session_start();

    //стартуем пользователя или выдаем ошибку
    if($user_id == null) {
        echo "Пользователя не существует!";
        die();
    } else {
        $_SESSION['user'] = $user_id;
        
        //устанавливаем тип пользователя
        if ($user_type == 2) {
        $_SESSION['admin'] = true;
        } else {
        $_SESSION['admin'] = false;
    }
    }


    header('Location: /index.php');
 
?>

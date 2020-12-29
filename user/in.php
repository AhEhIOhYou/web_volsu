<?php
    require_once '../log.php';
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $pass = md5($pass."lolItsGettingHard");

    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
        die();
    }

    $usedata = $db->prepare("SELECT `id` FROM `user_list`
                        WHERE `login` = ?
                        AND `pass` = ?");
    $usedata->execute([$login, $pass]);

    $user_id = $usedata->fetchColumn();

    $type = $db->prepare("SELECT `type` FROM `user_list` WHERE `id` = ?");
    $type->execute([$user_id]);
    $user_type = $type->fetchColumn();

    session_start();

    if ($user_type == 1) {
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

    my_log('Пользователь  залогинился с id = ' . $_SESSION['user'] . ' и типом = ' . $user_type);

    header('Location: /index.php');
 
?>

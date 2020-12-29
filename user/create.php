<?php

    session_start();
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }
    require_once '../log.php';
    my_log('Не автор. пользователь на странице -create.php-');

    $name = $_POST['name'];
    $surName = $_POST['surname'];
    $email = $_POST['email'];

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $pass = md5($pass."lolItsGettingHard");


    function clean20($value = "") {
        $value = preg_replace('/\s/', '', $value);
        return $value;
    }

    $name = clean20($name);
    $surName = clean20($surName);

    $end = false;

    function check_length($value = "", $min, $max) {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }

    if ((check_length($login,5,30) === false)) {
        echo "Некорректная длина логина<br>";
        $end = true;
    }

    if ((check_length($pass,5,60) === false)) {
        echo "Некорректная длина пароля<br>";
        $end = true;
    }

    if (($email != NULL) && (filter_var($email, FILTER_VALIDATE_EMAIL) === false)) { 
        echo "Формат почтового ящика неправильный<br>";
        $end = true;
    }


    if ($end === true) {
        echo 'Ошибка!<br>';
        echo '<p><a href="/lk.create.php">Назад</a></p>';
    } else {
        
        try {
            $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            my_log('Ошибка подключения к бд -  ' . $e->getMessage());
            die();
        }

        
        $log_u = $db->prepare("SELECT count(`login`) FROM `user_list` WHERE `login` = ?");
        $log_u->execute([$login]);
        $res = $log_u->fetchColumn();
        
        if ($res == 1) {
            echo '<h3>Логин уже занят</h3>';
            echo '<p><a href="/lk.create.php">Назад</a></p>';
        } else {

            $db->prepare("INSERT INTO user_list (`name`,`surname`,`login`,`pass`,`email`,`type`)
                        VALUES(?, ?, ?, ?, ?, ?)")->execute([$name, $surName, $login, $pass, $email, 0]);

            $id = $db->lastInsertId();
        
            $_SESSION['user'] = $id; 

            my_log('Пользователь id = ' . $_SESSION['user'] . ' создан');

            header('Location:  /index.php');
        }

    }

?>
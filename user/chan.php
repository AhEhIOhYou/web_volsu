<?php

    function clean20($value = "") {
        $value = preg_replace('/\s/', '', $value);
        return $value;
    }

    $end = false;

    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: lk.index.php');
    }
    
    $id = $_SESSION['user'];
    $name = $_POST['n_name'];
    $surName = $_POST['n_surname'];
    $email = $_POST['n_email'];

    $login = $_POST['n_login'];

    $name = clean20($name);


    function check_length($value = "", $min, $max) {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }

    if (($name != NULL) && (check_length($login,3,40) === false)) {
        echo "Некорректная длина логина<br>";
        $end = true;
    }

    if (($surName != NULL) && (check_length($login,2,40) === false)) {
        echo "Некорректная длина логина<br>";
        $end = true;
    }

    if (($login != NULL) && (check_length($login,5,30) === false)) {
        echo "Некорректная длина логина<br>";
        $end = true;
    }

    if (($email != NULL) && (filter_var($email, FILTER_VALIDATE_EMAIL) === false)) { 
        echo "Формат почтового ящика неправильный<br>";
        $end = true;
    }

    if ($end === true) {
        die("Ошибка!");
    } 
    else {
        try {
            $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            die();
        }

        if ($name != NULL) {
            $db->prepare("UPDATE `user_list` SET `name` = ? WHERE `user_list`.`id` = ?")->execute([$name, $id]);
            header("Location: lk.index.php");
        }
        if ($surName != NULL) {
            $db->prepare("UPDATE `user_list` SET `surname` = ? WHERE `user_list`.`id` = ?")->execute([$surName, $id]);
            header("Location: lk.index.php");
        } 
        if ($email != NULL) {
            $db->prepare("UPDATE `user_list` SET `email` = ? WHERE `user_list`.`id` = ?")->execute([$email, $id]);
            header("Location: lk.index.php");
        }

        $log_u = $db->prepare("SELECT count(`login`) FROM `user_list` WHERE `login` = ?");
        $log_u->execute([$login]);
        $res = $log_u->fetchColumn();
        
        if ($res == 1) {
            echo '<h3>Логин уже занят</h3>';
            echo '<p><a href="lk.edit.php">Назад</a></p>';
        } else {
            if ($login != NULL) {
                $db->prepare("UPDATE `user_list` SET `login` = ? WHERE `user_list`.`id` = ?;")->execute([$login, $id]);
                header("Location: lk.index.php");
            }
        }
    }

?>
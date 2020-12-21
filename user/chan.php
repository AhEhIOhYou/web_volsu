<?php

    function clean20($value = "") {
        $value = preg_replace('/\s/', '', $value);
        return $value;
    }

    $end = false;

    session_start();
    if (!isset($_SESSION['useer'])) {
        header('Location: lk.index.php');
    }
    
    $id = $_SESSION['user'];

    $name = $_POST['n_name'];
    $surName = $_POST['n_surname'];
    $email = $_POST['n_email'];
    $tel = $_POST['n_tel'];
    $age = $_POST['n_age'];

    $login = $_POST['n_login'];
    $pass = $_POST['n_pass'];

    $login = clean20($login);

    $name = clean20($name);


    function check_length($value = "", $min, $max) {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }

    if (($login != NULL) && (check_length($login,5,30) === false)) {
        echo "Некорректная длина логина<br>";
        $end = true;
    }

    if (($pass != NULL) && (check_length($pass,5,30) === false)) {
        echo "Некорректная длина пароля<br>";
        $end = true;
    }

    if (($email != NULL) && (filter_var($email, FILTER_VALIDATE_EMAIL) === false)) { 
        echo "Формат почтового ящика неправильный<br>";
        $end = true;
    }

    if ($age != NULL) {
        if (($age > 150) || ($age < 1)) {
            echo "Некорректный возраст";
            $end = true;
        }
    }

    if ($end === true) {
        die("Ошибка!");
    } 
    else {
        try {
            $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            die();
        }

        if ($name != NULL) {
            $db->prepare("UPDATE `users_data` SET `name` = ? WHERE `users_data`.`id` = ?")->execute([$name, $id]);
        }
        if ($surName != NULL) {
            $db->prepare("UPDATE `users_data` SET `surname` = ? WHERE `users_data`.`id` = ?")->execute([$surName, $id]);
        } 
        if ($email != NULL) {
            $db->prepare("UPDATE `users_data` SET `email` = ? WHERE `users_data`.`id` = ?")->execute([$email, $id]);
        }
        if ($tel != NULL) {
            $db->prepare("UPDATE `users_data` SET `tel` = ? WHERE `users_data`.`id` = ?;")->execute([$tel, $id]);
        }
        if ($age != NULL) {
            $db->prepare("UPDATE `users_data` SET `age` = ? WHERE `users_data`.`id` = ?;")->execute([$age, $id]);
        }

    
        if ($login != NULL) {
            $db->prepare("UPDATE `users_data` SET `login` = ? WHERE `users_data`.`id` = ?;")->execute([$login, $id]);
        }
        if ($pass != NULL) {
            $db->prepare("UPDATE `users_data` SET `pass` = ? WHERE `users_data`.`id` = ?; ")->execute([$pass, $id]);
        }
    }
    header("Location: lk.index.php");

?>
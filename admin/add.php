<?php

    session_start();
    $tableName = $_SESSION['table'];

    if (!isset($tableName) || ($_SESSION['admin'] != true)) {
        header('Location: ../index.php');
    }

    
    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    $end = false;
    //проверяет в тб добавляем по переданному названию
    //первая - таблица пользователей
    if ($tableName === 'users_data') {

        $name = $_POST['name'];
        $surName = $_POST['surname'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $age = $_POST['age'];

        $login = $_POST['login'];
        $pass = $_POST['pass'];

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

            $db->prepare("INSERT INTO $tableName (`name`,`surname`,`login`,`pass`,`age`,`tel`,`email`)
                        VALUES( ?, ?, ?, ?, ?, ?, ? );")->execute([$name, $surName, $login, $pass, $age, $tel, $email]);

        }
    } //другая таблица - рейсов 
    elseif ($tableName === 'trips_data') {

        $place_from = $_POST['place_from'];
        $time_from = $_POST['time_from'];
        $place_to = $_POST['place_to'];
        $time_to = $_POST['time_to'];
        $price = $_POST['price'];

        if($price != NULL) {
            if(($price < 1) || ($price > 99999)) {
                echo "Некорректная цена поездки<br>";
                $end = true;
            }
        }
        if ($end === true) {
            die("Ошибка!");
        } else {  

            $db->prepare("INSERT INTO $tableName (`place_from`,`time_from`,`place_to`,`time_to`,`price`)
                        VALUES( ?, ?, ?, ?, ?)")->execute([$place_from, $time_from, $place_to, $time_to, $price]);

        }
    } //иначе таблица заказов 
    elseif ($tableName === 'orders') {

        $trip_id = $_POST['id_trip'];
        $user_id = $_POST['id_user'];  

            $db->prepare("INSERT INTO $tableName (`trip_id`,`user_id`) VALUES( ?, ?)")->execute([$trip_id, $user_id]);

        
    }
    header('Location:  main.php');
?>
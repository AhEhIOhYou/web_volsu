<?php

    session_start();
    $tableName = $_SESSION['table'];
    $id = $_POST['id'];

    if (!isset($tableName) || !isset($id)) {
        header('Location: ../main.php');
    }

    function clean20($value = "") {
        $value = preg_replace('/\s/', '', $value);
        return $value;
    }

    $end = false;

    if($tableName === 'users_data') {

        $name = $_POST['n_name'];
        $surName = $_POST['n_surname'];
        $email = $_POST['n_email'];
        $tel = $_POST['n_tel'];
        $age = $_POST['n_age'];

        $login = $_POST['n_login'];
        $pass = $_POST['n_pass'];

        $login = clean20($login);
        $name = clean20($name);
        $surName = clean20($surName);


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
        //Выкинет если не пройдешь валидацию 
        else {

            try {
                $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
            } catch (PDOException $e) {
                print "Ошибка подключпения к БД!: " . $e->getMessage();
                die();
            }


            if ($name != NULL) {
                $db->prepare("UPDATE $tableName SET `name` = ? WHERE $tableName . `id` = ?;")->execute([$name, $id]);
            }
            if ($surName != NULL) {
                $db->prepare("UPDATE $tableName SET `surname` = ? WHERE $tableName.`id` = ?;")->execute([$surName, $id]);
            } 
            if ($email != NULL) {
                $db->prepare("UPDATE $tableName SET `email` = ? WHERE $tableName.`id` = ?;")->execute([$email, $id]);
            }
            if ($tel != NULL) {
                $db->prepare("UPDATE $tableName SET `tel` = ? WHERE $tableName.`id` = ?;")->execute([$tel, $id]);
            }
            if ($age != NULL) {
                $db->prepare("UPDATE $tableName SET `age` = ? WHERE $tableName.`id` = ?;")->execute([$age, $id]);
            }
    
            if ($login != NULL) {
                $db->prepare("UPDATE $tableName SET `login` = ? WHERE $tableName.`id` = ?;")->execute([$login, $id]);
            }
            if ($pass != NULL) {
                $db->prepare("UPDATE $tableName SET `pass` = ? WHERE $tableName.`id` = ?;")->execute([$pass, $id]);
            }
        }
    } elseif ($tableName === 'trips_data') {

        $place_from = $_POST['n_place_from'];
        $time_from = $_POST['n_time_from'];
        $place_to = $_POST['n_place_to'];
        $time_to = $_POST['n_time_to'];
        $price = $_POST['n_price'];

        if($price != NULL) {
            if(($price < 1) || ($price > 99999)) {
                echo "Некорректная цена поездки<br>";
                $end = true;
            }
        }
        if ($end === true) {
            die("Ошибка!");
        } else {
            try {
                $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
            } catch (PDOException $e) {
                print "Ошибка подключпения к БД!: " . $e->getMessage();
                die();
            }

            if ($place_from != NULL) {
                $db->prepare("UPDATE $tableName SET `place_from` = ? WHERE $tableName.`id` = ?;")->execute([$place_from, $id]);
            } 
            if ($time_from != NULL) {
                $db->prepare("UPDATE $tableName SET `time_from` = ? WHERE $tableName.`id` = ?")->execute([$time_to< $id]);
            }
            if ($place_to != NULL) {
                $db->prepare("UPDATE $tableName SET `place_to` = ? WHERE $tableName.`id` = ?;")->execute([$place_to, $id]);
            }
            if ($time_to != NULL) {
                $db->prepare("UPDATE $tableName SET `time_to` = ? WHERE $tableName.`id` = ?;")->execute([$time_to, $id]);
            }
            if ($price != NULL) {
                $db->prepare("UPDATE $tableName SET `price` = ? WHERE $tableName.`id` = ?;")->execute([$price, $id]);
            }

        }
    }
    elseif ($tableName === 'orders') {

        $us_id = $_POST['n_id_user'];
        $tr_id = $_POST['n_id_train'];
        try {
            $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            die();
        }
        if ($us_id != NULL) {
            $db->prepare("UPDATE $tableName SET `user_id` = ? WHERE $tableName.`id` = ?;")->execute([$us_id, $id]);
        }
        if ($tr_id != NULL) {
            $db->prepare("UPDATE $tableName SET `train_id` = ? WHERE $tableName.`id` = ?;")->execute([$tr_id, $id]);
        }
    }
    
    header('Location: ../main.php');
?>
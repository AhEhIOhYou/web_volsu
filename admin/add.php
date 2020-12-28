<?php

    session_start();
    $tableName = $_SESSION['table'];

    if (!isset($tableName)) {
        header('Location: main.php');
    }

    function clean20($value = "") {
        $value = preg_replace('/\s/', '', $value);
        return $value;
    }

    $end = false;


    //ДОБАВЛЯЕМ ПОЛЬЗОВАТЕЛЯ
    if($tableName === 'user_list') {

        $name = $_POST['name'];
        $surName = $_POST['surname'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $login = $_POST['login'];
        $type = $_POST['type'];

    $surName = clean20($surName);


    function check_length($value = "", $min, $max) {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }

    if (($login != NULL) && (check_length($login,5,30) === false)) {
        echo "Некорректная длина логина<br>";
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
            $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            die();
        }

        //проверка на единственность
        $log_u = $db->prepare("SELECT count(`login`) FROM `user_list` WHERE `login` = ?");
        $log_u->execute([$login]);
        $res = $log_u->fetchColumn();
        
        if ($res == 1) {
            echo '<h3>Логин уже занят</h3>';
        } else {
        $db->prepare("INSERT INTO $tableName (`name`,`surname`,`login`,`pass`,`type`,`email`)
                    VALUES( ?, ?, ?, ?, ?, ?);")->execute([$name, $surName, $login, $pass, $type, $email]);
        }

    }
    } 
    
    //ДОБАВЛЯЕМ РЕЙС
    elseif ($tableName === 'trip_list') {

        $place_from = $_POST['place_from'];
        $time_from = $_POST['time_from'];
        $place_to = $_POST['place_to'];
        $time_to = $_POST['time_to'];
        $data_from = $_POST['data_from'];
        $train_id = $_POST['train_id'];
        $price = $_POST['price'];

        if($train_id != NULL) {
            if (($train_id < 1) || ($train_id > 10000)) {
                echo "Некорректный номер поезда<br>";
                $end = true;
            }
        }
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
                $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
            } catch (PDOException $e) {
                print "Ошибка подключпения к БД!: " . $e->getMessage();
                die();
            }   

            $db->prepare("INSERT INTO $tableName (`place_from`,`time_from`,`place_to`,`time_to`,`price`,`data_from`,`train_id`)
                        VALUES( ?, ?, ?, ?, ?, ?, ?)")->execute([$place_from, $time_from, $place_to, $time_to, $price, $data_from, $train_id]);

        }
    } 
    
    //ДОБАВЛЯЕМ ЗАКАЗ
    elseif ($tableName === 'order_list') {

        $trip_id = $_POST['trip_id'];
        $seat_number = $_POST['seat_number'];
        $user_id = $_POST['user_id'];
        
            try {
                $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
            } catch (PDOException $e) {
                print "Ошибка подключпения к БД!: " . $e->getMessage();
                die();
            }   

            $db->prepare("INSERT INTO $tableName (`trip_id`,`user_id`,`seat_number`)
                        VALUES( ?, ?, ?)")->execute([$trip_id, $user_id, $seat_number]);

    } 

    //ДОБАВЛЯЕМ ГОРОД
    elseif ($tableName === 'city_data') {

        $name = $_POST['c_name'];

        try {
            $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            die();
        }

        $db->prepare("INSERT INTO $tableName (`name`)
                        VALUES( ? )")->execute([$c_name]);

    } 
    
    //ДОБАВЛЯЕМ ИНФУ ПО КОВИДУ
    elseif ($tableName === 'quarantine_data') {
        $city_id = $_POST['city_id'];
        $info = $_POST['info'];
        $rel = $_POST['relevance'];

        try {
            $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            die();
        }

        $db->prepare("INSERT INTO $tableName (`city_id`,`info`,`relevance`)
                        VALUES( ?,?,? )")->execute([$city_id, $info, $rel]);
} 

//ДОБАВЛЯЕМ ПОГОДУ
    elseif ($tableName === 'weather_data') {
        
        $city_id = $_POST['city_id'];
        $data = $_POST['data'];

        try {
            $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            die();
        }

        $db->prepare("INSERT INTO $tableName (`city_id`,`data`)
                        VALUES( ?,? )")->execute([$city_id, $data]);
    } 

    //ДОБАВЛЯЕМ МЕСТО
    elseif ($tableName === 'seats_list') {
        
        $train_id = $_POST['train_id'];
        $number = $_POST['number'];
        $state = $_POST['state'];
    
        try {
            $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            die();
        }
    
        $db->prepare("INSERT INTO $tableName (`train_id`,`number`,`state`)
                        VALUES( ?,?,? )")->execute([$train_id, $number, $state]);

    } 
    
    //ДОБАВЛЯЕМ ПОЕЗД
    elseif ($tableName === 'train_list') {
        
        $type = $_POST['type'];
    
        try {
            $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            die();
        }
    
        $db->prepare("INSERT INTO $tableName (`type`)
                        VALUES( ? )")->execute([$type]);
    
        } 

    
    header('Location:  main.php');
?>
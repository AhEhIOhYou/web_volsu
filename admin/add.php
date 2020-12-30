<?php

    session_start();
    if (($_SESSION['admin'] != true)) {
        header('Location: ../index.php');
    }
    $tableName = $_SESSION['table'];

    if (!isset($tableName)) {
        header('Location: main.php');
    }
    require_once '../log.php';
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -add.php-');

    function clean20($value = "") {
        $value = preg_replace('/\s/', '', $value);
        return $value;
    }

    
    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
        die();
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
        echo "Некорректная длина логина.  Обязательно: 5 - 30 символов<br>";
        $end = true;
    }

    if (($pass != NULL) && (check_length($login,5,30) === false)) {
        echo "Некорректная длина пароля. Обязательно: 5 - 30 символов<br>";
        $end = true;
    }

    if (($email != NULL) && (filter_var($email, FILTER_VALIDATE_EMAIL) === false)) { 
        echo "Формат почтового ящика неправильный<br>";
        $end = true;
    }


    if ($end === true) {
        die("Ошибка!");
    } 
    //Выкинет если не пройдешь валидацию 
    else {  

        //проверка на единственность
        $log_u = $db->prepare("SELECT count(`login`) FROM `user_list` WHERE `login` = ?");
        $log_u->execute([$login]);
        $res = $log_u->fetchColumn();
        
        if ($res == 1) {
            echo '<h3>Логин уже занят</h3>';
        } else {
            $pass = md5($pass."lolItsGettingHard");
            $db->prepare("INSERT INTO $tableName (`name`,`surname`,`login`,`pass`,`type`,`email`)
                        VALUES( ?, ?, ?, ?, ?, ?);")->execute([$name, $surName, $login, $pass, $type, $email]);

            $id = $db->lastInsertId();
            my_log('Пользователь id = ' . $_SESSION['user'] . ' добавил (user_list) id = ' . $id);
            
            header('Location: /admin/tables/table_users.php');
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
        $train_number = $_POST['train_number'];
        $price = $_POST['price'];

        $db->prepare("INSERT INTO $tableName (`place_from`,`place_to`,`time_from`,`time_to`,`price`,`data_from`,`train_number`)
                    VALUES( ?, ?, ?, ?, ?, ?, ?)")->execute([$place_from, $place_to, $time_from, $time_to, $price, $data_from, $train_number]);
        
        $id = $db->lastInsertId();
        my_log('Пользователь id = ' . $_SESSION['user'] . ' добавил (trip_list) id = ' . $id);
        
        header('Location: /admin/tables/table_trips.php');
    } 
    
    //ДОБАВЛЯЕМ ЗАКАЗ
    elseif ($tableName === 'order_list') {

        $trip_id = $_POST['trip_id'];
        $seat_id = $_POST['seat_id'];
        $user_id = $_POST['user_id'];  

        //поиск id поезда, для последующего поиска места, по номеру поезда из данных рейса
        $t_id = $db-> prepare("SELECT `train_list`.`id` FROM `train_list`,`trip_list` 
                                WHERE  `trip_list`.`id` = ? AND `trip_list`.`train_number` = `train_list`.`number`");
        $t_id->execute([$trip_id]);
        $id_train = $t_id->fetchColumn();

        $s_id = $db-> prepare("SELECT count(`id`) FROM `seats_list` WHERE  `train_id` = ? AND `id` = ?");
        $s_id->execute([$id_train, $seat_id]);
        $is_seat = $s_id->fetchColumn();
        
        //если место не связано с поездам - ошибка
        if ($is_seat == 0) {
            die('Такого места в поезде рейса не существует');
        }

        $db->prepare("INSERT INTO $tableName (`trip_id`,`user_id`,`seat_number`)
                    VALUES( ?, ?, ?)")->execute([$trip_id, $user_id, $seat_id]);

        $id = $db->lastInsertId();
        my_log('Пользователь id = ' . $_SESSION['user'] . ' добавил (order_list) id = ' . $id);

        $db->prepare("UPDATE `seats_list` SET `state` = ? WHERE `id` = ?")->execute([0,$seat_id]);
        
        header('Location: /admin/tables/table_orders.php');
    } 

    //ДОБАВЛЯЕМ ГОРОД
    elseif ($tableName === 'city_data') {

        $name = $_POST['c_name'];

        $db->prepare("INSERT INTO $tableName (`name`)
                        VALUES( ? )")->execute([$name]);

        $_SESSION['data'] = $_POST['data'];
        $_SESSION['info'] = $_POST['info'];
        $_SESSION['relevance'] = $_POST['relevance'];

        $id = $db->lastInsertId();
        $_SESSION['city_id'] = $id; 

        $id = $db->lastInsertId();
        my_log('Пользователь id = ' . $_SESSION['user'] . ' добавил (city_data) id = ' . $id);

        header('Location:  add_city_info.php');
    } 

    //ДОБАВЛЯЕМ МЕСТО
    elseif ($tableName === 'seats_list') {
        
        $train_number = $_POST['train_number'];
        $number = $_POST['number'];
        $state = $_POST['state'];

        $t_id = $db-> prepare("SELECT `id` FROM `train_list` WHERE  `number` = ?");
        $t_id->execute([$train_number]);
        $train_id = $t_id->fetchColumn();

        $db->prepare("INSERT INTO $tableName (`train_id`,`number`,`state`)
                        VALUES( ?,?,? )")->execute([$train_id, $number, $state]);

        $id = $db->lastInsertId();
        my_log('Пользователь id = ' . $_SESSION['user'] . ' добавил (seats_list) id = ' . $id);
        
        header('Location: /admin/tables/table_seats.php');
    } 
    
    //ДОБАВЛЯЕМ ПОЕЗД
    elseif ($tableName === 'train_list') {
        
        $type = $_POST['type'];
        $number = $_POST['number'];

        $db->prepare("INSERT INTO $tableName (`type`,`number`)
                        VALUES( ?,? )")->execute([$type,$number]);

        $id = $db->lastInsertId();
        my_log('Пользователь id = ' . $_SESSION['user'] . ' добавил (train_list) id = ' . $id);        

            header('Location: /admin/tables/table_trains.php');   
    } 

?>
<?php

session_start();
$tableName = $_SESSION['table'];
$id = $_POST['id'];

function clean20($value = "") {
    $value = preg_replace('/\s/', '', $value);
    return $value;
}

$end = false;

try {
    $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
} catch (PDOException $e) {
    print "Ошибка подключпения к БД!: " . $e->getMessage();
    die();
}


//РЕДАКТИРУЕМ ПОЛЬЗОВАТЕЛЯ
if($tableName === 'user_list') {

    $name = $_POST['n_name'];
    $surName = $_POST['n_surname'];
    $email = $_POST['n_email'];
    $login = $_POST['n_login'];
    
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
        if ($name != NULL) {
            $db->prepare("UPDATE $tableName SET `name` = ? WHERE $tableName . `id` = ?;")->execute([$name, $id]);
        }
        if ($surName != NULL) {
            $db->prepare("UPDATE $tableName SET `surname` = ? WHERE $tableName.`id` = ?;")->execute([$surName, $id]);
        } 
        if ($login != NULL) {
            $db->prepare("UPDATE $tableName SET `login` = ? WHERE $tableName . `id` = ?;")->execute([$name, $login]);
        }
        if ($email != NULL) {
            $db->prepare("UPDATE $tableName SET `email` = ? WHERE $tableName.`id` = ?;")->execute([$email, $id]);
        }
    }
    header('Location: /admin/tables/table_users.php');

}
} 

//РЕДАКТИРУЕМ РЕЙС
elseif ($tableName === 'trip_list') {
    $tableName;
    
    $place_from = $_POST['n_place_from'];
    $time_from = $_POST['n_time_from'];
    $place_to = $_POST['n_place_to'];
    $time_to = $_POST['n_time_to'];
    $data_from = $_POST['n_data_from'];
    $train_id = $_POST['n_train_id'];
    $price = $_POST['n_price'];
    
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

        
        if ($place_from != NULL) {
            $db->prepare("UPDATE $tableName SET `place_from` = ? WHERE $tableName.`id` = ?;")->execute([$place_from, $id]);
        } 
        if ($time_from != NULL) {
            $db->prepare("UPDATE $tableName SET `time_from` = ? WHERE $tableName.`id` = ?")->execute([$time_to, $id]);
        }
        if ($place_to != NULL) {
            $db->prepare("UPDATE $tableName SET `place_to` = ? WHERE $tableName.`id` = ?;")->execute([$place_to, $id]);
        }
        if ($time_to != NULL) {
            $db->prepare("UPDATE $tableName SET `time_to` = ? WHERE $tableName.`id` = ?;")->execute([$time_to, $id]);
        }
        if ($data_from != NULL) {
            $db->prepare("UPDATE $tableName SET `data_from` = ? WHERE $tableName.`id` = ?;")->execute([$data_from, $id]);
        }
        if ($train_id != NULL) {
            $db->prepare("UPDATE $tableName SET `train_id` = ? WHERE $tableName.`id` = ?;")->execute([$train_id, $id]);
        }
        if ($price != NULL) {
            $db->prepare("UPDATE $tableName SET `price` = ? WHERE $tableName.`id` = ?;")->execute([$price, $id]);
        }
        header('Location: /admin/tables/table_trips.php');
    }
} 

//РЕДАКТИРУЕМ ЗАКАЗ
elseif ($tableName === 'order_list') {

    $trip_id = $_POST['n_trip_id'];
    $seat_number = $_POST['n_seat_number'];
    $user_id = $_POST['n_user_id']; 

        if ($trip_id != NULL) {
            $db->prepare("UPDATE $tableName SET `trip_id` = ? WHERE $tableName.`id` = ?;")->execute([$trip_id, $id]);
        }
        if ($seat_number != NULL) {
            $db->prepare("UPDATE $tableName SET `seat_number` = ? WHERE $tableName.`id` = ?;")->execute([$seat_number, $id]);
        }
        if ($user_id != NULL) {
            $db->prepare("UPDATE $tableName SET `user_id` = ? WHERE $tableName.`id` = ?;")->execute([$user_id, $id]);
        }
        header('Location: /admin/tables/table_orders.php');
} 

//РЕДАКТИРУЕМ ГОРОД
elseif ($tableName === 'city_data') {

    $name = $_POST['n_name'];

    if ($name != NULL) {
        $db->prepare("UPDATE $tableName SET `name` = ? WHERE $tableName.`id` = ?;")->execute([$name, $id]);
    }
    header('Location: /admin/tables/table_city.php');
} 

//РЕДАКТИРУЕМ МЕСТО
elseif ($tableName === 'seats_list') {
    
    $train_id = $_POST['n_train_id'];
    $number = $_POST['n_number'];
    $state = $_POST['n_state'];

    if ($train_id != NULL) {
        $db->prepare("UPDATE $tableName SET `train_id` = ? WHERE $tableName.`id` = ?;")->execute([$train_id, $id]);
    }
    if ($number != NULL) {
        $db->prepare("UPDATE $tableName SET `number` = ? WHERE $tableName.`id` = ?;")->execute([$number, $id]);
    }
    if ($state != NULL) {
        $db->prepare("UPDATE $tableName SET `state` = ? WHERE $tableName.`id` = ?;")->execute([$state, $id]);
    }
    header('Location: /admin/tables/table_seats.php');
} 

//РЕДАКТИРУЕМ ПОЕЗД
elseif ($tableName === 'train_list') {
    
    $type = $_POST['n_type'];

    if ($type != NULL) {
        $db->prepare("UPDATE $tableName SET `type` = ? WHERE $tableName.`id` = ?;")->execute([$type, $id]);
    }
    header('Location: /admin/tables/table_train.php');
}

//РЕДАКТИРУЕМ ПОГОДУ
elseif ($tableName === 'weather_data') {
    
    $data = $_POST['n_data'];

    if ($data != NULL) {
        $db->prepare("UPDATE $tableName SET `data` = ? WHERE $tableName.`city_id` = ?;")->execute([$data, $id]);
    }
    header('Location: /admin/tables/table_weth.php');
}

//РЕДАКТИРУЕМ КОРОНУ
elseif ($tableName === 'quarantine_data') {
    
    $info = $_POST['n_info'];
    $relevance = $_POST['n_relevance'];

    if ($info != NULL) {
        $db->prepare("UPDATE $tableName SET `info` = ? WHERE $tableName.`city_id` = ?;")->execute([$info, $id]);
    }
    if ($relevance != NULL) {
        $db->prepare("UPDATE $tableName SET `relevance` = ? WHERE $tableName.`city_id` = ?;")->execute([$relevance, $id]);
    }
    
    header('Location: /admin/tables/table_covid.php');
}

?>
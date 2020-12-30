<?php require_once 'log.php';?>
<?php 
    session_start();

    if(!isset($_SESSION['user']) || !isset($_SESSION['trip'])) {
        header('Location:  /user/lk.login.php');
    }

    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -buy.php-');

    //все необхоимое для оформления заказа
    $trip_id = $_POST['key_trip_id'];
    $seat = $_POST['seat'];
    $id_user = $_SESSION['user'];

    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
        die();
    }

    $isorder = $db->query("SELECT COUNT(`trip_id`) as count FROM `order_list` 
                        WHERE `user_id` = $id_user AND `trip_id` = $trip_id")->fetchColumn();
    if ($isorder > 0) {
        echo '<h1>Билет уже был вами приобретен</h1>';
        echo '<a href="trips_list.php">К списку</a>';
    } else {

        //поиск id поезда, для последующего поиска мест, по номеру поезда из данных рейса
        $t_id = $db-> prepare("SELECT `train_list`.`id` FROM `train_list`,`trip_list` 
                                WHERE  `trip_list`.`id` = ? AND `trip_list`.`train_number` = `train_list`.`number`");
        $t_id->execute([$trip_id]);
        $id_train = $t_id->fetchColumn();

        //поиск id места, по id поезда и передаваемому номеру
        $s_id = $db-> prepare("SELECT `id` FROM `seats_list` WHERE  `number` = ? AND `train_id` = ?");
        $s_id->execute([$seat,$id_train]);
        $id_seat = $s_id->fetchColumn();

        //формируем заказ и записываем
        $db->prepare("INSERT INTO `order_list` (`trip_id`,`seat_number`,`user_id`)
                        VALUES(?, ?, ?)")->execute([$trip_id, $id_seat, $id_user]);
        
        
        $id = $db->lastInsertId();
        
        //изменяем состояние занятого места
        $db->prepare("UPDATE `seats_list` SET `state` = ? WHERE `id` = ?")->execute([1,$id_seat]);
        
        my_log('Пользователь id = ' . $_SESSION['user'] . ' совершил заказ id = ' . $id);

        echo "<h1>Успешно!</h1>";
        echo '<a href="/index.php">На главную</a>';
    }
?>
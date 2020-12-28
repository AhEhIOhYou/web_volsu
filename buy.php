<?php require_once 'log.php';?>
<?php 
    session_start();
    unset($_SESSION['table']);
    if(!isset($_SESSION['user'])) {
        header('Location:  /user/lk.login.php');
    }
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -buy.php-');

    $id_train = $_POST['key']; //1
    $seat = $_POST['seat']; //4
    $id_user = $_SESSION['user']; //2


    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
        die();
    }

    $trip_id = $_SESSION['trip'];
    $isorder = $db->query("SELECT COUNT(`trip_id`) as count FROM `order_list` 
                        WHERE `user_id` = $id_user AND `trip_id` = $trip_id")->fetchColumn();
    if ($isorder > 0) {
        echo '<h1>Билет уже был вами приобретен</h1>';
        echo '<a href="trips_list.php">К списку</a>';
    } else {

        $s_id = $db-> prepare("SELECT `id` FROM `seats_list` WHERE  `number` = ? AND `train_id` = ?");
        $s_id->execute([$seat,$id_train]);
        $id_seat = $s_id->fetchColumn();

        $db->prepare("INSERT INTO `order_list` (`trip_id`,`seat_number`,`user_id`)
                        VALUES(?, ?, ?)")->execute([$trip_id, $id_seat, $id_user]);
        
        $id = $db->lastInsertId();
        
        unset($_SESSION['trip']);

        $db->prepare("UPDATE `seats_list` SET `state` = ? WHERE `train_id` = ? AND `id` = ?")->execute([1,$id_train,$id_seat]);
        
        my_log('Пользователь id = ' . $_SESSION['user'] . ' совершил заказ id = ' . $id);

        echo "<h1>Успешно!</h1>";
        echo '<a href="/index.php">На главную</a>';
    }
?>
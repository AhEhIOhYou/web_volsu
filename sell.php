<?php require_once 'log.php';?>
<?php
    session_start();
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -sell.php-');
    $tripDelete_id = $_POST['trip_id'];
    $user = $_SESSION['user'];

    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
        die();
    }
    $seat_c = $db->prepare("SELECT `seat_number` FROM `order_list` WHERE `trip_id` = ? AND `user_id` = ?");
    $seat_c->execute([$tripDelete_id,$user]);
    $id_s = $seat_c->fetchColumn();

    //id для лога
    $or_id = $db->prepare("SELECT `id` FROM `order_list` WHERE `trip_id` = ? AND `user_id` = ?");
    $or_id->execute([$tripDelete_id,$user]);
    $id = $or_id->fetchColumn();

    $db->prepare("DELETE FROM `order_list` WHERE `trip_id` = ? AND `user_id` = ?")->execute([$tripDelete_id, $user]);
    $db->prepare("UPDATE `seats_list` SET `state` = ? WHERE `id` = ?")->execute([0,$id_s]);
    echo "<h1>Успешно!</h1>";
    echo '<a href="user/lk.index.php">В личный кабинет</a>';
    my_log('Пользователь id = ' . $_SESSION['user'] . ' отменил заказ id = ' . $id . ', местом = ' . $id_s . ' с рейса = ' . $tripDelete_id);
?>
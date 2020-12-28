<?php
    $deleteTrainId = $_POST['key'];
    session_start();
    $user = $_SESSION['user'];

    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }
    $seat_c = $db->prepare("SELECT `seat_number` FROM `order_list` WHERE `trip_id` = ? AND `user_id` = ?");
    $seat_c->execute([$deleteTrainId,$user]);
    $num_s = $seat_c->fetchColumn();

    $db->prepare("DELETE FROM `order_list` WHERE `trip_id` = ? AND `user_id` = ?")->execute([$deleteTrainId, $user]);
    $db->prepare("UPDATE `seats_list` SET `state` = ? WHERE `train_id` = ? AND `id` = ?")->execute([0,$deleteTrainId,$num_s]);
    echo "<h1>Успешно!</h1>";
    echo '<a href="user/lk.index.php">В личный кабинет</a>';
?>
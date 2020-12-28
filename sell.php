<?php
    $deleteTrainId = $_POST['key_id'];
    session_start();
    $user = $_SESSION['user'];

    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    $db->prepare("DELETE FROM `orders` WHERE `train_id` = ? AND `user_id` = ?")->execute([$deleteTrainId, $user]);
    echo "<h1>Успешно!</h1>";
    echo '<a href="user/lk.index.php">В личный кабинет</a>';
?>

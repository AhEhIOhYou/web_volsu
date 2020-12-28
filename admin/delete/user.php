<?php

    session_start();
    $tableName = $_SESSION['table'];
    $deleteId = $_POST['id'];

    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    $or = $db->prepare("SELECT count(`user_id`) FROM `order_list` WHERE `user_id` = ?");
    $or->execute([$deleteId]);
    $res = $or->fetchColumn();

    if ($res == 0) {
        $db->prepare("DELETE FROM `user_list` WHERE `id` = ?")->execute([$deleteId]);
        header('Location: /index.php');        
    } else {
        echo '<h3>Отмените его заказы</h3>';
    }
?>

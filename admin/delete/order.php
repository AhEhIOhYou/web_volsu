<?php
    session_start();
    if (($_SESSION['admin'] != true)) {
        header('Location: ../../index.php');
    }
    require_once '../../log.php';
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -order.php-');
    $tableName = $_SESSION['table'];
    $deleteId = $_POST['id'];

    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
        die();
    }


    $seat_c = $db->prepare("SELECT `seat_number` FROM `order_list` WHERE `id` = ?");
    $seat_c->execute([$deleteId]);
    $id_s = $seat_c->fetchColumn();

    $db->prepare("DELETE FROM `order_list` WHERE `id` = ?")->execute([$deleteId]);

    $db->prepare("UPDATE `seats_list` SET `state` = ? WHERE `id` = ?")->execute([0,$id_s]);

    my_log('Пользователь id = ' . $_SESSION['user'] . ' удалил (' . $tableName . ') заказ id = ' . $deleteId 
            . ', установил (seats_list) state = 0 у id = ' . $id_s);
    

    header('Location: ../main.php');
?>
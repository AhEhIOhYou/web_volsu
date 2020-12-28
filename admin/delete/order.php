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



    $seat_c = $db->prepare("SELECT `seat_number` FROM `order_list` WHERE `id` = ?");
    $seat_c->execute([$deleteId]);
    $id_s = $seat_c->fetchColumn();

    $db->prepare("DELETE FROM `order_list` WHERE `id` = ?")->execute([$deleteId]);

    $db->prepare("UPDATE `seats_list` SET `state` = ? WHERE `id` = ?")->execute([0,$id_s]);

    header('Location: ../main.php');
?>
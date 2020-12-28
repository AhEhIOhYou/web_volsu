<?php

    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    session_start();
    $tableName = $_SESSION['table'];
    $deleteId = $_POST['id'];

    $db->prepare("DELETE FROM $tableName WHERE $tableName.`id` = ?")->execute([$deleteId]);
    header('Location: ../main.php');
?>
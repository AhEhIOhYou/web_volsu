<?php

    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    session_start();
    $tableName = $_SESSION['table'];
    $deleteId = $_POST['id'];

    if (!isset($deleteId) || !isset($tableName)) {
        header('Location: ../index.php');
    }

    $db->prepare("DELETE FROM $tableName WHERE `id` = ?")->execute([$deleteId]);

    header('Location: ../main.php');
?>
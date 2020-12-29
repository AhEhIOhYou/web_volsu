<?php
    session_start();
    require_once '../../log.php';
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -delete.php-');
    
    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
        die();
    }

    $tableName = $_SESSION['table'];
    $deleteId = $_POST['id'];

    my_log('Пользователь id = ' . $_SESSION['user'] . ' удалил (' . $tableName . ') id = ' . $deleteId . ' и все связанные данные');

    $db->prepare("DELETE FROM $tableName WHERE $tableName.`id` = ?")->execute([$deleteId]);
    header('Location: ../main.php');
?>
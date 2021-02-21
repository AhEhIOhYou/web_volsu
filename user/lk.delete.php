<?php

    session_start();

    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }
    //удаляем текущий активный id
    $user = $_SESSION['user'];
    $db->prepare("DELETE FROM `users_data` WHERE `id` = ?")->execute([$user]);
    //снимаем данные сессии
    unset($_SESSION['user']);
    unset($_SESSION['admin']);

    header('Location: /index.php');
?>

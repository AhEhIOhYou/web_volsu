<?php

    session_start();

    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    $user = $_SESSION['user'];
    $db->prepare("DELETE FROM `users_data` WHERE `id` = ?")->execute([$user]);

    unset($_SESSION['user']);
    unset($_SESSION['admin']);

    header('Location: /index.php');
?>

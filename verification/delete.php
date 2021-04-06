<?php

    session_start();

    try {
        $db = new PDO('mysql:host=localhost;dbname=users', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }


    $user = $_SESSION['user'];

    $db->query("DELETE FROM `users_list` WHERE `id` = '$user' ");

    unset($_SESSION['user']);

    header('Location: /');
?>

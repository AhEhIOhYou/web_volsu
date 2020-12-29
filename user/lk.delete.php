<?php

    session_start();

    require_once '../log.php';
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -lk.delete.php-');

    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
        die();
    }

    $user = $_SESSION['user'];
    $or = $db->prepare("SELECT count(`user_id`) FROM `order_list` WHERE `user_id` = ?");
    $or->execute([$user]);
    $res = $or->fetchColumn();
    if ($res == 0) {
        $db->prepare("DELETE FROM `user_list` WHERE `id` = ?")->execute([$user]);

        my_log('Пользователь id = ' . $_SESSION['user'] . ' удален');

        unset($_SESSION['user']);
        unset($_SESSION['admin']);
        header('Location: /index.php');        
    } else {
        my_log('Пользователь id = ' . $_SESSION['user'] . ' не отменил заказы перед удалением');
        echo '<h3>Отмените свои заказы!</h3>';
        echo '<p><a href="lk.index.php">Назад</a></p>';
    }
?>

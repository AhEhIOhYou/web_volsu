<?php require_once '../log.php';?>
<?php
    session_start();
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -lk.logout.php-');
    my_log('Пользователь id = ' . $_SESSION['user'] . ' разлогинился');
    unset($_SESSION['user']);
    unset($_SESSION['admin']);
    header('Location: /index.php');
?>
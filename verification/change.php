<?php

    $newName = $_POST['name_ch'];
    $newSurName = $_POST['surName_ch'];
    $newLogin = $_POST['login_ch'];
    $newTel = $_POST['tel_ch'];
    $newEmail = $_POST['email_ch'];


    try {
        $db = new PDO('mysql:host=localhost;dbname=users', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }
    session_start();
    $user = $_SESSION['user'];
    

    if ($newName != NULL) {
        $db->query("UPDATE `users_list` SET `name` = '$newName' WHERE `users_list`.`id` = '$user'; ");
    }
    if ($newLogin != NULL) {
        $db->query("UPDATE `users_list` SET `login` = '$newLogin' WHERE `users_list`.`id` = '$user'; ");
    } 
    if ($newEmail != NULL) {
        $db->query("UPDATE `users_list` SET `email` = '$newEmail' WHERE `users_list`.`id` = '$user'; ");
    }
    if ($newSurName != NULL) {
        $db->query("UPDATE `users_list` SET `surname` = '$newSurName' WHERE `users_list`.`id` = '$user'; ");
    }
    if ($newTel != NULL) {
        $db->query("UPDATE `users_list` SET `tel` = '$newTel' WHERE `users_list`.`id` = '$user'; ");
    }
    
    header('Location: lk.index.php');
?>
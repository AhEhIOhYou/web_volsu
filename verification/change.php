<?php

    $newName = $_POST['name_ch'];
    $newSurName = $_POST['surName_ch'];
    $newLogin = $_POST['login_ch'];
    $newTel = $_POST['tel_ch'];
    $newEmail = $_POST['email_ch'];


    $db_host='localhost';
    $db_name='users';
    $db_user='root';
    $db_pass='';
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

    $user = $_COOKIE['user'];

    if ($newName != NULL) {
        $mysqli->query("UPDATE `users_list` SET `name` = '$newName' WHERE `users_list`.`id` = '$user'; ");
    }
    if ($newLogin != NULL) {
        $mysqli->query("UPDATE `users_list` SET `login` = '$newLogin' WHERE `users_list`.`id` = '$user'; ");
    } 
    if ($newEmail != NULL) {
        $mysqli->query("UPDATE `users_list` SET `email` = '$newEmail' WHERE `users_list`.`id` = '$user'; ");
    }
    if ($newSurName != NULL) {
        $mysqli->query("UPDATE `users_list` SET `surname` = '$newSurName' WHERE `users_list`.`id` = '$user'; ");
    }
    if ($newTel != NULL) {
        $mysqli->query("UPDATE `users_list` SET `tel` = '$newTel' WHERE `users_list`.`id` = '$user'; ");
    }
    

    $mysqli->close(); 
    header('Location: lk.index.php');
?>
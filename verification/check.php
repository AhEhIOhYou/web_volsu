<?php

    $name = $_POST['name'];
    $surName = $_POST['surname'];
    $login = $_POST['login'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if(mb_strlen($login) < 5 || mb_strlen($login) > 90) {
        echo "Недопустимая длина логина";
        exit();
    } elseif(mb_strlen($name) < 3 || mb_strlen($name) > 50) {
        echo "Недопустимая длина имени";
        exit();
    } elseif(mb_strlen($pass) < 5 || mb_strlen($pass) > 50) {
        echo "Недопустимая длина пароля (от 5 до 50 символов)";
        exit();
    }

    $pass = md5($pass."lolItsGettingHard");

    $db_host='localhost';
    $db_name='users';
    $db_user='root';
    $db_pass='';
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

    $mysqli->query("INSERT INTO `users_list` (`login`, `pass`, `name`, `surname`,`tel`,`email`)
    VALUES('$login','$pass','$name','$surName','$tel','$email')");

    $result = $mysqli->query("SELECT * FROM `users_list`
                            WHERE `email` = '$login' OR `login` = '$login'
                            AND `pass` = '$pass'");
    $user = $result->fetch_assoc();
    setcookie('user', $user['id'], time() + 3600, "/");

    $mysqli->close();

    header('Location:  lk.index.php');

?>

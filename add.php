<?php

    $name = $_POST['name'];
    $surName = $_POST['surname'];
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $end = false;
    function check_length($value = "", $min, $max) {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }

    if (($login == NULL) && (check_length($login,5,30) === false)) {
        echo "Некорректная длина логина<br>";
        $end = true;
    }

    if (($pass == NULL) && (check_length($pass,5,30) === false)) {
        echo "Некорректная длина пароля<br>";
        $end = true;
    }

    if (($email != NULL) && (filter_var($email, FILTER_VALIDATE_EMAIL) === false)) { 
        echo "Формат почтового ящика неправильный<br>";
        $end = true;
    }

    if ($age != NULL ) {
        if (($age > 150) || ($age < 1)) {
            echo "Некорректный возраст<br>";
            $end = true;
        }
    }

    if ($end === true) {
        die();
    } 
    
    else {

    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    $db->prepare("INSERT INTO `users_data` (`name`,`surname`,`login`,`pass`,`age`,`tel`,`email`)
                VALUES ( ?, ?, ?, ?, ?, ?, ?);")->execute([$name, $surName, $login, $pass, $age, $tel, $email]);

    header('Location:  showUsers.php');
}   

?>
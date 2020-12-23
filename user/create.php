<?php
    session_start();
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }


    $name = $_POST['name'];
    $surName = $_POST['surname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $age = $_POST['age'];

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    function clean20($value = "") {
        $value = preg_replace('/\s/', '', $value);
        return $value;
    }

    $name = clean20($name);
    $surName = clean20($surName);

    $end = false;

    function check_length($value = "", $min, $max) {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }

    if (($login != NULL) && (check_length($login,5,30) === false)) {
        echo "Некорректная длина логина<br>";
        $end = true;
    }

    if (($pass != NULL) && (check_length($pass,5,30) === false)) {
        echo "Некорректная длина пароля<br>";
        $end = true;
    }

    if (($email != NULL) && (filter_var($email, FILTER_VALIDATE_EMAIL) === false)) { 
        echo "Формат почтового ящика неправильный<br>";
        $end = true;
    }

    if ($age != NULL) {
        if (($age > 150) || ($age < 1)) {
            echo "Некорректный возраст<br>";
            $end = true;
        }
    }

    if ($end === true) {
        die("Ошибка!");
    } else {
        
        try {
            $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            die();
        }

        $db->prepare("INSERT INTO users_data (`name`,`surname`,`login`,`pass`,`age`,`tel`,`email`)
                    VALUES(?, ?, ?, ?, ?, ?, ?)")->execute([$name, $surName, $login, $pass, $age, $tel, $email]);

        $id = $db->lastInsertId();
        
        $_SESSION['user'] = $id; 

        header('Location:  /index.php');

    }



?>
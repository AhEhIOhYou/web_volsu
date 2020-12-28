<?php
        session_start();
        $city_id = $_SESSION['city_id'];
        unset($_SESSION['city_id']);
        $data = $_SESSION['data'];

        $info = $_SESSION['info'];
        $rel = $_SESSION['relevance'];

        try {
            $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            die();
        }
        
        $db->prepare("INSERT INTO `quarantine_data` (`city_id`,`info`,`relevance`)
                        VALUES( ?,?,? )")->execute([$city_id, $info, $rel]);

        $db->prepare("INSERT INTO `weather_data` (`city_id`,`data`)
                VALUES( ?,? )")->execute([$city_id, $data]);

        unset($_SESSION['data']);
        unset($_SESSION['info']);
        unset($_SESSION['relevance']);
        header('Location:  main.php');
?>
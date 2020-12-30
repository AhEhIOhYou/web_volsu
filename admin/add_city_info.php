<?php
        session_start();
        if (($_SESSION['admin'] != true)) {
            header('Location: ../index.php');
        }
        $city_id = $_SESSION['city_id'];
        unset($_SESSION['city_id']);
        $data = $_SESSION['data'];
        require_once '../log.php';
        my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -add_city_info.php-');

        $info = $_SESSION['info'];
        $rel = $_SESSION['relevance'];

        try {
            $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
        } catch (PDOException $e) {
            print "Ошибка подключпения к БД!: " . $e->getMessage();
            my_log('Ошибка подключения к бд -  ' . $e->getMessage());
            die();
        }

        $city_n = $db->prepare("SELECT `name` FROM `city_data` WHERE `id` = ?");
        $city_n->execute([$city_id]);
        $city_name = $city_n->fetchColumn();
        
        $db->prepare("INSERT INTO `quarantine_data` (`city_name`,`info`,`relevance`)
                        VALUES( ?,?,? )")->execute([$city_name, $info, $rel]);

        $db->prepare("INSERT INTO `weather_data` (`city_name`,`data`)
                VALUES( ?,? )")->execute([$city_name, $data]);

        
        my_log('Пользователь id = ' . $_SESSION['user'] . ' добавил (quarantine_data) city_id = ' . $city_id);
        my_log('Пользователь id = ' . $_SESSION['user'] . ' добавил (weather_data) city_id = ' . $city_id);

        unset($_SESSION['data']);
        unset($_SESSION['info']);
        unset($_SESSION['relevance']);
        header('Location: /admin/tables/table_cities.php');
?>
<?php require_once 'log.php';?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <title>AutoTrain | Main</title>
    </head>
    <body>
        <header class="site-header">
            <div class="lk-items-cont">

            <?php
                    session_start();
                    if (!isset($_SESSION['user'])) { 
            ?>

                <form class="lk-item" action="user/lk.login.php" method="GET">
                    <button class="lk_bttn">Войти</button>
                </form>
            <?php 
                    } else { my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -search.php-');
            ?>
                <form class="lk-item" action="user/lk.index.php" method="GET">
                    <button class="lk_bttn">Личный кабинет</button>
                </form>

            <?php } ?>

                <form class="lk-item" action="user/lk.create.php" method="GET">
                    <button class="lk_bttn">Регистрация</button>
                </form>
            </div>
        </header>
        <main>
            <section class="main-cont">
                <h1 class="title">Поиск билетов</h1><br>
                <h3>Найти билеты по городам</h3>
                <form name="search" method="POST" action="search.php">
                    <input type="search" name="query" placeholder="Откуда/Куда">
                    <button type="submit">Найти</button> 
                </form><br>
                <?php
                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
                    die();
                    }
                    $query = $_POST['query'];
                    $query = trim($query);
                    $query = htmlspecialchars($query);
                    if (!empty($query))  { 

                        my_log('Поиск: -' . $query . '-');

                        $train_q = $db->prepare("SELECT * FROM trip_list WHERE (place_from LIKE ? OR place_to LIKE ?)");
                        $train_q->execute(["%$query%", "%$query%"]);
                        while($row = $train_q->fetch(PDO::FETCH_BOTH)) {
                            $id = array_shift($row);
                            $arr[$id] = array($row[1],$row[2],$row[3],$row[4],$row[6],$row[7],$row[5]);
                        }
                        
                        if (!empty($arr)) {
                            echo '<h3>Найдено:</h3>';
                            foreach($arr as $key => $value) {?>

                                <div style="display: flex; width: 1200px; height: 20px; border: 1px black solid;">
                                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Откуда</div>
                                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Куда</div>
                                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время отправления</div>
                                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время прибытия</div>
                                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Дата</div>
                                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Номер поезда</div>
                                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Цена</div>
                                </div>
    
                                <?php

                                    echo '<div style="display: flex; width: 1320px; height: 20px; border: 1px black solid;">';
                                    echo '<div class="from" data-attr="'.$value[0].'" style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[0] . '</div>';
                                    echo '<div class="to" data-attr="'.$value[1].'" style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[1] . '</div>';
                                    for ($i = 2; $i < count($value); $i++) {
                                        echo '<div style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[$i] . '</div>';
                                    }

                                    echo '<form method="POST" action="trip_all_info.php">
                                        <button style="width: 120px;" value="' . $key . '" name="trip_id">Подробнее</button>    
                                    </form>

                                    </div><br><br>'; 
                                    
                            }
                            my_log('Успешный поиск: -' . $query . '-');
                        } else {
                            echo '<p>Ничего не найдено!</p>';
                            my_log('Ничего не найдено: -' . $query . '-');
                        }}
                        else {
                            echo '<p>Задан пустой поисковый запрос.</p>';
                            
                            $log = 'Пустой поиск';
                            my_log($log);
                        } 
                    ?>
                    <h3><a href="index.php">Назад</a></h3>
            </script>
        </main>
    </body>
</html>
<?php require_once 'log.php';?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>AutoTrain | List</title>
        <link rel="stylesheet" href="styles.css">
        <script src="map.js" type="text/javascript"></script>
    </head>
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
                    } else { my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -trips_list.php-');
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
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Список всех рейсов</h1><br>
                <?php 
                
                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
                        die();
                    }

                    $trips = $db->query("SELECT * from `trip_list`");
                                             
                    while($row = $trips->fetch(PDO::FETCH_BOTH)) 
                    {
                        $id = array_shift($row);
                        $arr[$id] = array($row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]);
                    }
                    foreach($arr as $key => $value) {?>

                    <div style="display: flex; width: 1200px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Откуда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Куда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время отправления</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время прибытия</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Дата</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Цена</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Номер поезда</div>
                    </div>
    
                    <?php

                        echo '<div style="display: flex; width: 1320px; height: 20px; border: 1px black solid;">';
                            for ($i = 0; $i < count($value); $i++) {
                                echo '<div style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[$i] . '</div>';
                            }

                            echo '<form method="POST" action="trip_all_info.php">
                                    <button style="width: 120px;" value="' . $key . '" name="key">Подробнее</button>    
                                </form>

                        </div><br><br>'; 
                    }
                ?>
                <h3><a href="index.php">На главную</a></h3>

            </section>
        </main>
    </body>
</html>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
        <title>AutoTrain | Info</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=745e20c7-8361-47ce-b3b0-85d22cea5438" type="text/javascript"></script>
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
                    } else {
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
                <h1 class="title">Информация о поезде</h1><br>
                <?php 
                
                    try {
                        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }

                    $key = $_POST['key'];

                    $train = $db->prepare("SELECT * from `trips_data` WHERE id = ?");
                    $train->execute([$key]);
                                             
                    while($row = $train->fetch(PDO::FETCH_BOTH)) 
                    {
                        $id = array_shift($row);
                        $arr[$id] = array($row[1],$row[2],$row[3],$row[4],$row[5]);
                    }

                    foreach($arr as $key => $value) {?>

                    <div style="display: flex; width: 1200px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Номер поезда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Откуда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Куда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время отправления</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время прибытия</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Цена</div>
                    </div>
    
                    <?php

                        echo '<div style="display: flex; width: 1320px; height: 20px; border: 1px black solid;">';
                        echo '<div style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $key . '</div>';
                        echo '<div class="from" data-attr="'.$value[0].'" style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[0] . '</div>';
                        echo '<div class="to" data-attr="'.$value[1].'" style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[1] . '</div>';
                            for ($i = 2; $i < count($value); $i++) {
                                echo '<div style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[$i] . '</div>';
                            }

                            echo '<form method="POST" action="buy.php">
                                    <button style="width: 120px;" value="' . $key . '" name="key">Купить!</button>    
                                </form>

                        </div><br><br>'; 
                    }
                ?>
                <div id="map" style="width: 100%; height: 500px"></div>
                <h3 id="len"></h3>
                <h3><a href="trainList.php">Назад</a></h3>
            </section>
        </main>
    </body>
</html>
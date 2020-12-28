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
                <h1 class="title">Информация о поездке</h1><br>
                <?php 
                
                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }

                    $key = $_POST['key'];
                    $_SESSION['trip'] = $key;

                    $trip = $db->prepare("SELECT * from `trip_list` WHERE id = ?");
                    $trip->execute([$key]);
                                             
                    while($row = $trip->fetch(PDO::FETCH_BOTH)) 
                    {
                        $id = array_shift($row);
                        $arr[$id] = array($row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]);
                    }
                    $train = "";

                    foreach($arr as $key => $value) {?>

                    <div style="display: flex; width: 1200px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Откуда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Куда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время отправления</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время прибытия</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Цена</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Дата</div>
                    </div>
    
                    <?php

                        echo '<div style="display: flex; width: 1200px; height: 20px; border: 1px black solid;">';                        
                        echo '<div class="from" data-attr="'.$value[0].'" style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[0] . '</div>';
                        echo '<div class="to" data-attr="'.$value[1].'" style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[1] . '</div>';

                        for ($i = 2; $i < count($value) - 1; $i++) {
                            echo '<div style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[$i] . '</div>';
                        }
                        
                        $city_from = $value[0];
                        $city_to = $value[1];
                        $train_id = $value[6];
                    
                        $seats_s = $db->prepare("SELECT `number` FROM `seats_list` WHERE `train_id` = ? AND `state` = 0");
                        $seats_s->execute([$train_id]);
                        $arr_s = array();                        
                        ?>
                        </div>

                        <div style="text-align: center;">
                        <form method="POST" action="buy.php">
                            <h3>Выбрать место</h3>
                            <select  name="seat">
                            <?php
                            while ($arr_s = $seats_s->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val) {
                                ?> 
                                    <option style="width: 100px; padding-left: 5px;"><button value="<?php echo $val ?>"><?php echo $val ?></button></option>
                                <?php       
                                }
                            }?>
                            </select>
                            <button style="width: 150px; height: 50px" value="<?php echo $train_id ?>" name="key">Купить!</button>
                        </form>
                        </div>

                        <br><br>
                        <?php
                        $train = $db-> prepare("SELECT `type` FROM `train_list` WHERE `id` = ?");
                        $train->execute([$value[6]]);
                        

                        $city_id_found_from = $db-> prepare("SELECT `id` FROM `city_data` WHERE `name` = ?");
                        $city_id_found_from->execute([$value[0]]);  
                        $id_from = $city_id_found_from->fetchColumn();
                        
                        $we_from = $db->prepare("SELECT `data` FROM `weather_data` WHERE `city_id` = ?");
                        $we_from->execute([$id_from]);
                        
                        $city_id_found_to = $db-> prepare("SELECT `id` FROM `city_data` WHERE `name` = ?");
                        $city_id_found_to->execute([$value[1]]);  
                        $id_to = $city_id_found_to->fetchColumn();
                                                
                        $we_to = $db->prepare("SELECT `data` FROM `weather_data` WHERE `city_id` = ?");
                        $we_to->execute([$id_to]);

                        $c_info = $db->prepare("SELECT `info` FROM `quarantine_data` WHERE `city_id` = ?");
                        $c_info->execute([$id_to]);
                        
                        $c_info_rel = $db->prepare("SELECT `relevance` FROM `quarantine_data` WHERE `city_id` = ?");
                        $c_info_rel->execute([$id_to]);

                    }?>
            <div style="display: flex; width: 100%; height: 400px">
            <div>
                
                        <?php
                        echo '<h3 style="padding-left: 80px;">Тип поезда</h3>';

                        echo '<div style="border: 1px black dashed; width: 250px; text-align: center;">';
                        $train_type = $train->fetchColumn();
                        if ($train_type == 1) {
                            echo 'СКОРОСТНОЙ';
                        } else {
                            echo 'ОБЫЧНЫЙ';
                        }
                        echo '</div>';

                        echo '<h3 style="padding-left: 100px;">Погода</h3>';

                        echo '<div style="border: 1px black dashed; width: 250px; height: 70px; display:flex; justify-content: center;">';
                        $weather_from = $we_from->fetchColumn();
                        echo '<div style="align-self: center;">';
                        echo $city_from . " : " . $weather_from;
                        echo '</div></div>';

                        echo '<div style="border: 1px black dashed; width: 250px; height: 70px; display:flex; justify-content: center;">';
                        $weather_to = $we_to->fetchColumn();
                        echo '<div style="align-self: center;">';
                        echo $city_to . " : " . $weather_to;
                        echo '</div></div>';

                        echo '<h3 style="padding-left: 95px;">COVID</h3>';

                        echo '<div style="border: 1px black dashed; width: 250px; height: 70px; display:flex; justify-content: center;">';
                        $cov = $c_info->fetchColumn();
                        $rel = $c_info_rel->fetchColumn();
                        echo '<div style="align-self: center;">';
                        echo $city_to . " : " . $cov;
                        if ($rel == 1) {
                            echo '<br>Актуально';
                        } else {
                            echo '<br>Не Актуально';
                        }
                        echo '</div></div>';
                ?>
            </div>
                <div id="map" style="width: 100%; height: 400px; padding-left: 50px;"></div>
            </div>
                <h3><a href="trips_list.php">Назад</a></h3>
            </section>
        </main>
    </body>
</html>
<?php require_once 'log.php';?>
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
                        my_log('Не автор. пользователь на странице -trips_list.php-');
            ?>

                <form class="lk-item" action="user/lk.login.php" method="GET">
                    <button class="lk_bttn">Войти</button>
                </form>
            <?php 
                    } else { 
                        my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -trip_all_info.php-');
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
                        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
                        die();
                    }

                    $key_trip_id = $_POST['trip_id'];
                    $_SESSION['trip'] = $key_trip_id;

                    $trip = $db->prepare("SELECT * from `trip_list` WHERE id = ?");
                    $trip->execute([$key_trip_id]);
                                             
                    while($row = $trip->fetch(PDO::FETCH_BOTH)) 
                    {
                        $id = array_shift($row);
                        $arr[$id] = array($row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]);
                    }

                    foreach($arr as $key_trip_id => $value) :?>

                    <div style="display: flex; width: 1200px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Откуда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Куда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время отправления</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время прибытия</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Цена</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Дата</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Номер поезда</div>
                    </div>

                    <div style="display: flex; width: 1200px; height: 20px; border: 1px black solid;">
                        <div class="from" data-attr="<?php echo $value[0]; ?>" style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $value[0];?></div>
                        <div class="to" data-attr="<?php echo $value[1]; ?>" style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $value[1]; ?></div>

                        <?php for ($i = 2; $i < count($value); $i++) : ?>
                            <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $value[$i]; ?></div>
                        <?php 
                        endfor;
                        
                        $city_from = $value[0];
                        $city_to = $value[1];
                        $train_number = $value[6];

                        $tr_id = $db-> prepare("SELECT `id` FROM `train_list` WHERE `number` = ?");
                        $tr_id->execute([$train_number]);
                        $train_id = $tr_id->fetchColumn();

                    
                        $seats_s = $db->prepare("SELECT `number` FROM `seats_list` WHERE `train_id` = ? AND `state` = 0");
                        $seats_s->execute([$train_id]);
                        $arr_s = array();

                        $free_s = $db->prepare("SELECT count(`number`) FROM `seats_list` WHERE `train_id` = ? AND `state` = 0");
                        $free_s->execute([$train_id]);
                        $check = $free_s->fetchColumn();

                        ?>
                    </div>
                    <?php if ($check < 1) {
                        echo '<h3 style="text-align: center;">Мест нет!</h3><br><br>';
                    } else { ?>
                    <div style="text-align: center;">
                        <form method="POST" action="buy.php">
                            <h3>Выбрать место</h3>
                            <select  name="seat">
                            <?php
                            while ($arr_s = $seats_s->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val; ?></option>
                                <?php endforeach;
                            }?>
                            </select>
                            <button style="width: 150px; height: 50px" value="<?php echo $train_id ?>" name="key_train_id">Купить!</button>
                        </form>
                    </div>
                
                        
                        <?php
                        }
                        $train = $db-> prepare("SELECT `type` FROM `train_list` WHERE `id` = ?");
                        $train->execute([$train_number]);
                        
                        $we_from = $db->prepare("SELECT `data` FROM `weather_data` WHERE `city_name` = ?");
                        $we_from->execute([$city_from]);
                        
                        $we_to = $db->prepare("SELECT `data` FROM `weather_data` WHERE `city_name` = ?");
                        $we_to->execute([$city_to]);

                        $c_info = $db->prepare("SELECT `info` FROM `quarantine_data` WHERE `city_name` = ?");
                        $c_info->execute([$city_from]);
                        
                        $c_info_rel = $db->prepare("SELECT `relevance` FROM `quarantine_data` WHERE `city_name` = ?");
                        $c_info_rel->execute([$city_to]);

                    endforeach;?>
                    <br><br>
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
                        echo $city_from . ": " . $weather_from;
                        echo '</div></div>';

                        echo '<div style="border: 1px black dashed; width: 250px; height: 70px; display:flex; justify-content: center;">';
                        $weather_to = $we_to->fetchColumn();
                        echo '<div style="align-self: center;">';
                        echo $city_to . ": " . $weather_to;
                        echo '</div></div>';

                        $rel = $c_info_rel->fetchColumn();
                        if ($rel == 1) {
                            echo '<h3 style="padding-left: 95px;">COVID</h3>';

                            echo '<div style="border: 1px black dashed; width: 250px; height: 70px; display:flex; justify-content: center;">';
                            $cov = $c_info->fetchColumn();
                            echo '<div style="align-self: center;">';
                            echo $city_to . " : " . $cov;
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
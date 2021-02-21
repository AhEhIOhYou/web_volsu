<!DOCTYPE html>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
        <title>AutoTrain | Search</title>
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
                <h1 class="title">Список всех рейсов</h1><br>
                <?php 
                
                    try {
                        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }

                    //извлекаем все данные о рейсах и выводим их
                    $trips = $db->query("SELECT * from `trips_data`");
                                             
                    while($row = $trips->fetch(PDO::FETCH_BOTH)) 
                    {
                        $id = array_shift($row);
                        $arr[$id] = array($row[1],$row[2],$row[3],$row[4],$row[5]);
                    }

                    foreach($arr as $key => $value) : ?>

                    <div style="display: flex; width: 1200px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Номер поезда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Откуда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Куда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время отправления</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время прибытия</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Цена</div>
                    </div>

                    <div style="display: flex; width: 1320px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $key ?></div>
                        
                        <?php for ($i = 0; $i < count($value); $i++) : ?>
                            <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $value[$i];?></div>
                        <?php endfor;?>
                        
                        <form method="POST" action="buy.php">
                            <button style="width: 120px;" value="<?php echo $key;?>" name="id_trip">Купить!</button>    
                        </form>

                    </div><br><br>
                    <?php endforeach;?>
                <h3><a href="index.php">На главную</a></h3>
            </section>
        </main>
    </body>
</html>
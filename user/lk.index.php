<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>AutoTrain | My account</title>
    </head>
    <body>
        <main>
        <?php 
            session_start();
            if (isset($_SESSION['user'])) : ?>
            <div  class="title">
                <h1>Ваш личный кабинет</h1>
            </div>
            <section class="main-settings">
                <div class="set-box">
                <p class="description">Здесь вы можете настроить свои персональные данные</p>
                <?php

                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }
                    
                    $user = $_SESSION['user'];


                    $usedata = $db-> prepare("SELECT `name` FROM `user_list` WHERE `id` = ?");
                    $usedata->execute([$user]);

                    $name = $usedata->fetchColumn();  
                    //запрос на получение инфы о маршруте
                    $trips = $db->prepare("SELECT `trip_list`.* from `trip_list`, `order_list` 
                                            WHERE trip_list.id = `order_list`.`trip_id` 
                                            AND `order_list`.`user_id` = ?");
                    $trips->execute([$user]); 

                    while($row = $trips->fetch(PDO::FETCH_BOTH)) 
                    {
                        $id = array_shift($row);
                        $arr[$id] = array($row[1],$row[2],$row[3],$row[4],$row[6],$row[5],$row[7]);
                    }

                    if (!empty($arr)) {
                        echo "<h3>Ваши купленные билеты</h3>";
                        echo '<div style="display: flex; width: 1200px; height: 20px; border: 1px black solid;">
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Номер поезда</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Откуда</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Куда</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время отправления</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время прибытия</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Дата</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Цена</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Место</div>
                    </div>';
                    
                    foreach ($arr as $key => $value) {
                        echo '<div style="display: flex; width: 1450px; height: 20px; border: 1px black solid;">';

                        echo '<div style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[6]. '</div>';
                            for ($i = 0; $i < count($value) - 1; $i++) {
                                echo '<div style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[$i] . '</div>';
                            }
                            //запрос на получение места
                            $s_a = $db->prepare("SELECT `seats_list`.`number` FROM `seats_list`,`order_list` 
                                                    WHERE `order_list`.`trip_id` = ? AND `order_list`.`user_id` = ?
                                                    AND `order_list`.`seat_number` = `seats_list`.`id`");
                            $s_a->execute([$key,$user]);
                            $seat = $s_a->fetchColumn();

                        echo '<div style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $seat. '</div>';
                        echo '<form method="POST" action="../../trip_all_info.php">
                                <button style="width: 100px;" value="' . $key . '" name="key">О маршруте</button>
                            </form>';
                        echo '<form method="POST" action="../../sell.php">
                                <button style="width: 150px;" value="' . $key . '" name="key">Отменить покупку!</button>
                            </form>
                        </div>'; 
                    }
                    }
                    

                    ?>
                    <p>Приветсвуем, <?php echo $name?>!</p>
                    <p>Чтобы удалить свой аккаунт нажмите <a href="lk.delete.php">сюда</a><br>
                    Для редактированния данных аккаунта перейдите <a href="lk.edit.php">сюда</a><br>
                    Чтобы выйти нажмите <a  href="lk.logout.php">здесь</a><br>
                    Чтобы перейти на главную нажмите <a href="/index.php">здесь</a><br><br>
                </div>
            </section>
            <?php else:  header('Location: /index.php'); ?>
            <?php endif ?>
        </main>
    </body>
</html>

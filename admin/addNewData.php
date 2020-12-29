<?php 
    session_start();
    $tableName = $_SESSION['table'];
    if (!isset($tableName)) {
        header('Location: ../index.php');
    }
    require_once '../log.php';
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -addNewData.php-');
    
    try {
        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        my_log('Ошибка подключения к бд -  ' . $e->getMessage());
        die();
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="m_styles.css">
        <meta charset="utf-8">
        <title>AutoTrain | Admin</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Создание</h1> <br>  
                
                <?php if ($tableName === 'user_list') {?>

                <form method="POST" action="add.php" class="reg-form">
                    <input type="text" name="name" placeholder="Имя" required>
                    <input type="text" name="surname" placeholder="Фамилия" required>
                    <input type="text" name="login" placeholder="Логин" required>
                    <input type="password" name="pass" placeholder="Пароль" required>
                    <input type="email" name="email" placeholder="Почта">
                    <select  name="type">
                        <option style="width: 100px; padding-left: 5px;" val="1">1 - Админ</option>
                        <option style="width: 100px; padding-left: 5px;" val="0">0 - Обычный</option>
                    </select>

                    <button type="submit">Создать</button>
                </form>
                
                
                <?php } if ($tableName === 'trip_list') {?>
                    <div style="display: flex; width: 980px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Откуда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Куда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время прибытия</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Дата</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Поезд</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Цена</div>
                    </div><br>
                <form method="POST" action="add.php" class="reg-form">
                    <select  name="place_from">
                            <?php
                            $f_all = $db->query("SELECT `name` FROM `city_data`");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>
                    <input type="text" name="time_from" placeholder="Время отправления" required>
                    <select  name="place_to">
                            <?php
                            $f_all = $db->query("SELECT `name` FROM `city_data`");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>
                    <input type="text" name="time_to" placeholder="Время прибытия" required>
                    <input type="text" name="data_from" placeholder="Дата" required>
                    <select  name="train_number">
                            <?php
                            $f_all = $db->query("SELECT `number` FROM `train_list`");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>
                    <input type="number" name="price" placeholder="Цена" required>

                    <button type="submit">Создать</button>
                </form> 

                <?php } if ($tableName === 'order_list') {?>
                    <div style="display: flex; width: 380px; height: 20px; border: 1px black solid;">
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id рейса</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id места</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id пользователя</div>
                    </div><br>
                <form method="POST" action="add.php" class="reg-form">
                    <select  name="trip_id">
                            <?php
                            $f_all = $db->query("SELECT `id` FROM `trip_list`");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>
                    <select  name="seat_number">
                            <?php
                            $f_all = $db->query("SELECT `id` FROM `seats_list` WHERE `state` = 0");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>
                    <select  name="user_id">
                            <?php
                            $f_all = $db->query("SELECT `id` FROM `user_list`");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>

                    <button type="submit">Создать</button>
                </form> 

                <?php } if ($tableName === 'city_data') {?>

                <form method="POST" action="add.php" class="reg-form">

                    <h3>Информация о городе</h3>
                    
                    <input type="text" name="c_name" placeholder="Название" required>
                    
                    <h3>COVID info</h3>
                    
                    <input type="text" name="info" placeholder="Инфо" required>
                    <input type="text" name="relevance" placeholder="Актуальность" required>
                    
                    <h3>Погода</h3>
                    <input type="text" name="data" placeholder="Инфо" required>

                    <button type="submit">Создать</button>
                </form>

                <?php } if ($tableName === 'seats_list') {?>
                    <div style="display: flex; width: 406px; height: 20px; border: 1px black solid;">
                        <div style="width: 35%; padding-left: 5px; outline: 1px black solid;">id поезда</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">Собст. номер</div>
                        <div style="width: 35%; padding-left: 5px; outline: 1px black solid;">Состояние</div>
                    </div><br>
                <form method="POST" action="add.php" class="reg-form">
                    <select  name="train_id">
                            <?php
                            $f_all = $db->query("SELECT `id` FROM `train_list`");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>
                    <input type="number" name="number" placeholder="Номер" required>
                    <select  name="state">
                        <option style="width: 100px; padding-left: 5px;" val="0">Свободно - 0</option>
                        <option style="width: 100px; padding-left: 5px;" val="1">Занято - 1</option>
                    </select>
                    <button type="submit">Создать</button>
                </form> 
                
                <?php } if ($tableName === 'train_list') {?>
                
                <form method="POST" action="add.php" class="reg-form">
                <div style="display: flex; width: 280px; height: 20px; border: 1px black solid;">
                        <div style="width: 50%; padding-left: 5px; outline: 1px black solid;">Тип</div>
                        <div style="width: 50%; padding-left: 5px; outline: 1px black solid;">Номер</div>
                    </div><br>
                    <select  name="type">
                        <option style="width: 100px; padding-left: 5px;" val="1">1 - СКОРОСТНОЙ</option>
                        <option style="width: 100px; padding-left: 5px;" val="0">0 - ОБЫЧНЫЙ</option>
                    </select>
                    <input type="number" name="number" placeholder="Номер поезда" required>
                    <button type="submit">Создать</button>
                </form> 
                <?php }?>
                <h3><a href="main.php">Отмена</a></h3>
            </section>
        </main>
    </body>
</html>
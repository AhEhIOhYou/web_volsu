<?php 
    session_start();
    $tableName = $_SESSION['table'];
    if (!isset($tableName) || ($_SESSION['admin'] != true)) {
        header('Location: ../index.php');
    }
    
    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
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
                <?php if ($tableName === 'users_data') {?>

                <form method="POST" action="add.php" class="reg-form">
                    <input type="text" name="name" placeholder="Имя" required>
                    <input type="text" name="surname" placeholder="Фамилия" required>
                    <input type="text" name="login" placeholder="Логин" required>
                    <input type="password" name="pass" placeholder="Пароль" required>
                    <input type="number" name="age" placeholder="Возраст">
                    <input type="email" name="email" placeholder="Почта" required>
                    <input type="tel" name="tel" placeholder="Телефон">

                    <button type="submit">Создать</button>
                </form> 
                <?php } if ($tableName === 'trips_data') {?>

                <form method="POST" action="add.php" class="reg-form">
                    <input type="text" name="place_from" placeholder="Место отправления" required>
                    <input type="text" name="time_from" placeholder="Время отправления" required>
                    <input type="text" name="place_to" placeholder="Место прибытия" required>
                    <input type="text" name="time_to" placeholder="Время прибытия" required>
                    <input type="number" name="price" placeholder="Цена" required>

                    <button type="submit">Создать</button>
                </form> 

                <?php } if ($tableName === 'orders') {?>
                    <div style="display: flex; width: 257px; height: 20px; border: 1px black solid;">
                        <div style="width: 50%; padding-left: 5px; outline: 1px black solid;">id пользователя</div>
                        <div style="width: 50%; padding-left: 5px; outline: 1px black solid;">id рейса</div>
                    </div>
                <form method="POST" action="add.php" class="reg-form">
                    <select  name="id_user">
                            <?php
                            $f_all = $db->query("SELECT `id` FROM `users_data`");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>
                    <select  name="id_trip">
                            <?php
                            $f_all = $db->query("SELECT `id` FROM `trips_data`");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>
                    <button type="submit">Создать</button>
                </form> 

                <?php }?>
                <h3><a href="main.php">Отмена</a></h3>
            </section>
        </main>
    </body>
</html>
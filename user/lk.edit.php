<?php
session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /index.php');
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <title>AutoTrain | Edit account</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Редактирование</h1> <br>  

                <div style="display: flex; width: 1000px; height: 20px; border: 1px black solid;">
                    <div style="width: 16%; padding-left: 5px; outline: 1px black solid;">Имя</div>
                    <div style="width: 16%; padding-left: 5px; outline: 1px black solid;">Фамилия</div>
                    <div style="width: 16%; padding-left: 5px; outline: 1px black solid;">Почта</div>
                    <div style="width: 16%; padding-left: 5px; outline: 1px black solid;">Телефон</div>
                    <div style="width: 16%; padding-left: 5px; outline: 1px black solid;">Возраст</div>
                    <div style="width: 16%; padding-left: 5px; outline: 1px black solid;">Логин</div>
                </div>
                        <?php

                            try {
                                $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
                            } catch (PDOException $e) {
                                print "Ошибка подключпения к БД!: " . $e->getMessage();
                                die();
                            }

                            $id = $_SESSION['user'];

                            $user = $db->prepare("SELECT `name`, `surname`, `email`, `tel`, `age`, `login`
                                                FROM `users_data` WHERE `id` = ?");
                            $user->execute([$id]);
                            $result = $user->fetch(PDO::FETCH_ASSOC); 
                            
                        ?>
                        
                    <div style="display: flex; width: 1000px; height: 20px; border: 1px black solid;">
                        <?php foreach($result as $key => $value) :?>
                            <div style="width: 16%; padding-left: 5px; outline: 1px black solid;"><?php echo $value; ?></div>
                        <?php endforeach; ?>
                    </div><br>


                <form method="POST" action="chan.php" class="reg-form">
                    <input type="text" name="n_name" placeholder="Имя">
                    <input type="text" name="n_surname" placeholder="Фамилия">
                    <input type="text" name="n_login" placeholder="Логин">
                    <input type="password" name="n_pass" placeholder="Пароль">
                    <input type="number" name="n_age" placeholder="Возраст">
                    <input type="email" name="n_email" placeholder="Почта">
                    <input type="tel" name="n_tel" placeholder="Телефон">

                    <button type="submit">Принять</button>
                </form> 

                <h3><a href="lk.index.php">Отмена</a></h3>
            </section>
        </main>
    </body>
</html>
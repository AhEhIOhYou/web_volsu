<?php
session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: lk.index.php');
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

                <div style="display: flex; width: 800px; height: 20px; border: 1px black solid;">
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;">Имя</div>
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;">Фамилия</div>
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;">Почта</div>                    
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;">Логин</div>
                </div>
                        <?php

                            require_once '../log.php';
                            my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -lk.edit.php-');

                            try {
                                $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                            } catch (PDOException $e) {
                                print "Ошибка подключпения к БД!: " . $e->getMessage();
                                my_log('Ошибка подключения к бд -  ' . $e->getMessage());
                                die();
                            }

                            $id = $_SESSION['user'];

                            $user = $db->prepare("SELECT `name`, `surname`, `email`, `login`
                                                FROM `user_list` WHERE `id` = ?");
                            $user->execute([$id]);
                            $result = $user->fetch(PDO::FETCH_ASSOC); 
                            

                            echo '<div style="display: flex; width: 800px; height: 20px; border: 1px black solid;">';
                            foreach($result as $key => $value)
                            {
                                echo '<div style="width: 25%; padding-left: 5px; outline: 1px black solid;">' . $value . '</div>';
                            }
                            echo '</div>';
                        ?><br>


                <form method="POST" action="chan.php" class="reg-form">
                    <input type="text" name="n_name" placeholder="Имя">
                    <input type="text" name="n_surname" placeholder="Фамилия">
                    <input type="text" name="n_login" placeholder="Логин">                    
                    <input type="email" name="n_email" placeholder="Почта">
                    <button type="submit">Принять</button>
                </form> 

                <h3><a href="lk.index.php">Отмена</a></h3>
            </section>
        </main>
    </body>
</html>
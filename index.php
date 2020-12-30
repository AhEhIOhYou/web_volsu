<?php session_start();
    unset($_SESSION['table']);
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <title>AutoTrain | Main</title>
    </head>
    <body>
        <header class="site-header">
            <div class="lk-items-cont">

            <?php
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
        <main>
            <section class="main-cont">
                <h1 class="title">Добро пожаловать на AutoTrain!</h1>
                <ul>
                <?php 
                    if ((isset($_SESSION['admin'])) && ($_SESSION['admin'] == true)) {
                ?>
                    <li>
                        <p>Администрирование</p>
                        <form action="admin/main.php" method="GET">
                            <button name="type" value="1">Открыть</button>
                        </form>
                    </li>
                <?php }?>
                    <li>
                        <p>Список рейсов</p>
                        <form action="/trips_list.php" method="GET">
                            <button>Показать</button>
                        </form>
                    </li>
                </ul>
                <h3>Найти билеты по городам</h3>
                <form name="search" method="POST" action="search.php">
                    <input type="search" name="query" placeholder="Откуда/Куда">
                    <button type="submit">Найти</button> 
                </form>
            </script>
        </main>
    </body>
</html>
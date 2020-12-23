<?php session_start();
    unset($_SESSION['table']);
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="m_styles.css">
        <meta charset="utf-8">
        <title>AutoTrain | Admin</title>
    </head>
    <header class="site-header">
            <div class="lk-items-cont">

            <?php
                    if (!isset($_SESSION['user'])) { 
            ?>

                <form class="lk-item" action="../../user/lk.login.php" method="GET">
                    <button class="lk_bttn">Войти</button>
                </form>
            <?php 
                    } else {
            ?>
                <form class="lk-item" action="../../user/lk.index.php" method="GET">
                    <button class="lk_bttn">Личный кабинет</button>
                </form>

            <?php } ?>

                <form class="lk-item" action="../../user/lk.create.php" method="GET">
                    <button class="lk_bttn">Регистрация</button>
                </form>
            </div>
        </header>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Управление БД</h1>
                <ul>
                    <li>
                        <p>Таблица пользователей</p>
                        <form action="tables/table_users.php" method="POST">
                            <button>Открыть</button>
                        </form>
                    </li>
                    <li>
                        <p>Таблица рейсов</p>
                        <form action="tables/table_trains.php" method="POST">
                            <button>Открыть</button>
                        </form>
                    </li>
                    <li>
                        <p>Таблица заказов</p>
                        <form action="tables/table_orders.php" method="POST">
                            <button>Открыть</button>
                        </form>
                    </li>
                    <li>
                        <p>Список рейсов</p>
                        <form action="/trainList.php" method="GET">
                            <button>Показать</button>
                        </form>
                    </li>
                </ul>
                <h3><a href="/index.php">Назад</a></h3>
            </script>
        </main>
    </body>
</html>
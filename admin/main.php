<?php session_start();
    unset($_SESSION['table']);
    if (!isset($_SESSION['user'])) {
        header('Location: ../index.php');
    }
    require_once '../log.php';
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -main.php-');
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
                <form class="lk-item" action="../../user/lk.index.php" method="GET">
                    <button class="lk_bttn">Личный кабинет</button>
                </form>

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
                        <form action="tables/table_trips.php" method="POST">
                            <button>Открыть</button>
                        </form>
                    </li>
                    <li>
                        <p>Таблица поездов</p>
                        <form action="tables/table_trains.php" method="POST">
                            <button>Открыть</button>
                        </form>
                    </li>
                    <li>
                        <p>Таблица мест</p>
                        <form action="tables/table_seats.php" method="POST">
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
                        <p>Таблица городов</p>
                        <form action="tables/table_cities.php" method="POST">
                            <button>Открыть</button>
                        </form>
                    </li>
                    <li>
                        <p>Таблица погоды</p>
                        <form action="tables/table_weth.php" method="POST">
                            <button>Открыть</button>
                        </form>
                    </li>
                    <li>
                        <p>Таблица COVID'а</p>
                        <form action="tables/table_covid.php" method="POST">
                            <button>Открыть</button>
                        </form>
                    </li>
                    <li>
                        <p>Список рейсов</p>
                        <form action="/trips_list.php" method="GET">
                            <button>Показать</button>
                        </form>
                    </li>
                </ul>
                <h3><a href="/index.php">Назад</a></h3>
            </script>
        </main>
    </body>
</html>
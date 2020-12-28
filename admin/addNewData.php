<?php 
    session_start();
    $tableName = $_SESSION['table'];
    if (!isset($tableName)) {
        header('Location: main.php');
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
                    <input type="password" name="pass" placeholder="Пароль">
                    <input type="email" name="email" placeholder="Почта" required>
                    <input type="number" name="type" placeholder="Тип" required>

                    <button type="submit">Создать</button>
                </form> 
                <?php } if ($tableName === 'trip_list') {?>

                <form method="POST" action="add.php" class="reg-form">
                    <input type="text" name="place_from" placeholder="Место отправления" required>
                    <input type="text" name="time_from" placeholder="Время отправления" required>
                    <input type="text" name="place_to" placeholder="Место прибытия" required>
                    <input type="text" name="time_to" placeholder="Время прибытия" required>
                    <input type="text" name="data_from" placeholder="Дата" required>
                    <input type="number" name="train_id" placeholder="Номер поезда" required>
                    <input type="number" name="price" placeholder="Цена" required>

                    <button type="submit">Создать</button>
                </form> 

                <?php } if ($tableName === 'order_list') {?>

                <form method="POST" action="add.php" class="reg-form">
                    <input type="number" name="trip_id" placeholder="id поездки" required>
                    <input type="number" name="seat_number" placeholder="id места" required>
                    <input type="number" name="user_id" placeholder="id пользователя" required>

                    <button type="submit">Создать</button>
                </form> 

                <?php } if ($tableName === 'city_data') {?>

                <form method="POST" action="add.php" class="reg-form">
                    <input type="text" name="c_name" placeholder="Название" required>

                    <button type="submit">Создать</button>
                </form> 

                <?php } if ($tableName === 'quarantine_data') {?>

                <form method="POST" action="add.php" class="reg-form">
                    <input type="text" name="city_id" placeholder="Город" required>
                    <input type="text" name="info" placeholder="Инфо" required>
                    <input type="text" name="relevance" placeholder="Актуальность" required>
                    <button type="submit">Создать</button>
                </form> 

                <?php } if ($tableName === 'weather_data') {?>

                <form method="POST" action="add.php" class="reg-form">
                    <input type="text" name="city_id" placeholder="Город" required>
                    <input type="text" name="data" placeholder="Инфо" required>
                    <button type="submit">Создать</button>
                </form> 

                <?php } if ($tableName === 'seats_list') {?>
                
                <form method="POST" action="add.php" class="reg-form">
                    <input type="number" name="train_id" placeholder="номер поезда" required>
                    <input type="number" name="number" placeholder="Номер" required>
                    <input type="number" name="state" placeholder="Состояние" required>
                    <button type="submit">Создать</button>
                </form> 
                
                <?php } if ($tableName === 'train_list') {?>
                
                <form method="POST" action="add.php" class="reg-form">
                    <input type="number" name="type" placeholder="Тип поезда" required>
                    <button type="submit">Создать</button>
                </form> 
                <?php }?>
                <h3><a href="main.php">Отмена</a></h3>
            </section>
        </main>
    </body>
</html>
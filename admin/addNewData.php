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

                <form method="POST" action="add.php" class="reg-form">
                    <input type="number" name="id_user" placeholder="id пользователя" required>
                    <input type="number" name="id_train" placeholder="id заказа" required>

                    <button type="submit">Создать</button>
                </form> 

                <?php }?>
                <h3><a href="main.php">Отмена</a></h3>
            </section>
        </main>
    </body>
</html>
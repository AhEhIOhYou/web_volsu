<!DOCTYPE html>
<?php session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: /index.php');
        }
?>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <title>AutoTrain | Create account</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Создание</h1> <br>  
                    <form method="POST" action="create.php" class="reg-form">
                        <input type="text" name="name" placeholder="Имя">
                        <input type="text" name="surname" placeholder="Фамилия">
                        <input type="text" name="login" placeholder="Логин" required>
                        <input type="password" name="pass" placeholder="Пароль" required>
                        <input type="number" name="age" placeholder="Возраст">
                        <input type="email" name="email" placeholder="Почта">
                        <input type="tel" name="tel" placeholder="Телефон">

                        <button type="submit">Создать</button>
                        
                </form> 
                    <a href="/index.php">Отмена</a>
            </section>
        </main>
    </body>
</html>
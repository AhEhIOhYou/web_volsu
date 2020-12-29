
<?php require_once '../log.php';
      my_log('Не автор. пользователь на странице -lk.create.php-');
?>
<!DOCTYPE html>
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
                        <input type="text" name="name" placeholder="Имя" required>
                        <input type="text" name="surname" placeholder="Фамилия" required>
                        <input type="text" name="login" placeholder="Логин" required>
                        <input type="password" name="pass" placeholder="Пароль" required>
                        <input type="email" name="email" placeholder="Почта">
                        <button type="submit">Создать</button>
                </form> 
                    <a href="/index.php">Отмена</a>
            </section>
        </main>
    </body>
</html>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>AutoTrain | Login</title>
    </head>
    <body>
    <?php   session_start();
            if (!isset($_SESSION['user'])) : 
    ?>
    <div class="forms-box">
    <div class="form-item">
        <h1 class="title">Форма авторизации</h1>
        <form method="POST" action="in.php" class="reg-form">
            <input type="text" class="reg-form-item" name="login" id="login" placeholder="Введите логин">
            <input type="password" class="reg-form-item" name="pass" id="pass" placeholder="Введите пароль">
            <button type="submit" class="reg-form-item but">Войти!</button>
        </form>  
        <a href="/index.php">Отмена</a> 
    </div>
    </div>
    <?php else:  header('Location: /index.php'); ?>
    <?php endif ?>
    </body>
</html>
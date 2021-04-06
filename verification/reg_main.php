<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="styles_ver.css">
        <title>Форма регистрации</title>
    </head>
    <body>
        <div class="forms-box">
        <div class="form-item">
        <h1 class="title">Форма регистрации</h1> 
        <form method="POST" action="check.php" class="reg-form">
            <input type="text" class="reg-form-item" name="name" id="name" placeholder="Введите имя">
            <input type="text" class="reg-form-item" name="surname" id="surname" placeholder="Введите фамилию">
            <input type="tel" class="reg-form-item" name="tel" id="tel" placeholder="Введите телефон">
            <input type="email" class="reg-form-item" name="email" id="email" placeholder="Введите почту">
            <input type="text" class="reg-form-item" name="login" id="login" placeholder="Введите логин">
            <input type="password" class="reg-form-item" name="pass" id="pass" placeholder="Введите пароль">
            <button type="submit" class="reg-form-item but">Зарегестрироваться!</button>
        </form>   
        </div>
    </div>
    </body>
</html>
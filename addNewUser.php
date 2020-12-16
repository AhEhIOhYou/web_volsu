<!DOCTYPE html>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <title>YourSQL Admin</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Управление БД</h1>   

                <form method="POST" action="add.php" class="reg-form">
                    <input type="text" name="name" placeholder="Введите имя">
                    <input type="text" name="surname" placeholder="Введите фамилию">
                    <input type="text" name="login" placeholder="Введите логин">
                    <input type="password" name="pass" placeholder="Введите пароль">
                    <input type="number" name="age" placeholder="Введите возраст">
                    <input type="email" name="email" placeholder="Введите почту">
                    <input type="tel" name="tel" placeholder="Введите телефон">

                    <button type="submit">Создать</button>
                </form> 

                
            </script>
        </main>
    </body>
</html>
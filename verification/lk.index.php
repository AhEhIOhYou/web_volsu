<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <link rel="stylesheet" href="lk_style.css">
        <title>AutoTrain | My account</title>
    </head>
    <body>
        <main>
        <?php 
            session_start();
            if (isset($_SESSION['user'])) : ?>
            <div  class="title">
                <h1>Ваш личный кабинет</h1>
                <h3>Приветсвуем вас!</h3>
            </div>
            <section class="main-settings">
                <div class="set-box">
                <p class="description">Здесь вы можете настроить свои персональные данные</p>
                <?php

                    try {
                        $db = new PDO('mysql:host=localhost;dbname=users', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }

                    $user = $_SESSION['user'];
                    
                    $usedata = $db->query("SELECT * FROM users_list WHERE `id` = '$user'");
                    


                    while($row = $usedata->fetch(PDO::FETCH_ASSOC)) {
                        $id =  $row['id'];
                        $login = $row['login'];
                        $userName = $row['name'];
                        $userSurName = $row['surname'];
                        $email = $row['email'];
                        $tel = $row['tel'];
                    }

                    ?>
                    <form action="change.php" method="POST">
                        <p>Приветсвуем, <?php print_r($userName)?>!</p>
                        <p>Ваш логин: <?php print_r ($login);?><br>
                        <input placeholder="Новый логин" name="login_ch" id="login_ch"><br>

                        Ваше имя: <?php print_r($userName);?><br>
                        <input placeholder="Новое имя" name="name_ch" id="name_ch"><br>

                        Ваша фамилия: <?php print_r($userSurName)?><br>
                        <input placeholder="Новая фамилия" name="surName_ch" id="surName_ch"><br>

                        Ваш телефон: <?php if(!isset($tel)) {
                            print_r("отсутсвует");
                        } else print_r($tel);?><br>
                        <input placeholder="Новый телефон" name="tel_ch" id="tel_ch"><br>

                        Ваша почта: <?php if(!isset($email)) {
                            print_r("отсутсвует");
                        } else print_r($email); ?><br>
                        <input placeholder="Новая почта" name="email_ch" id="email_ch"><br>
                        <button>Изменить!</button><br>
                        </form>
                        
                    <p>Чтобы удалить свой аккаунт нажмите <a href="delete.php">сюда</a><br>
                    Чтобы выйти нажмите <a  href="exit.php">здесь</a><br>
                    Чтобы перейти на главную нажмите <a href="/index.php">здесь</a><br><br>
                    Так же можете отдохнуть от поиска билетов и <a href="/secret.php">посмотреть Евангелион с субтитрами</a></p>
                </div>
            </section>
            <?php else:  header('Location: /'); ?>
            <?php endif ?>
        </main>
    </body>
</html>
<!--by AhEhIOhYou 2020-->

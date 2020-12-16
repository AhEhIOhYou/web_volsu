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

                <?php

                try {
                    $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
                } catch (PDOException $e) {
                    print "Ошибка подключпения к БД!: " . $e->getMessage();
                    die();
                }
                

                $stmt = $db->query("SELECT COUNT(*) FROM `users_data`");
                
                $count = $stmt->fetch(PDO::FETCH_NUM)[0];
                if ($count === NULL) {
                    echo "<h1>Пусто</h1>";
                } else {
                
                echo '<div style="display: flex; width: 1220px; height: 20px; border: 1px black solid;">
                    <div style="width: 4%; padding-left: 5px; outline: 1px black solid;">ID</div>
                    <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">Имя</div>
                    <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">Фамилия</div>
                    <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">Почта</div>
                    <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">Телефон</div>
                    <div style="width: 10%; padding-left: 5px; outline: 1px black solid;">Возраст</div>
                    <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">Логин</div>
                    <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">Пароль</div>
                </div>';
                
                $arr = array();

                $user = $db->query("SELECT `id`,`name`,`surname`,`email`,`tel`,`age`,`login`,`pass` from `users_data`");
                    
                    while($row = $user->fetch(PDO::FETCH_BOTH))
                    {
                        $id = array_shift($row);
                        $arr[$id] = array($row['name'], $row['surname'], $row['email'], $row['tel'], $row['age'], $row['login'], $row['pass']);
                    }

                    
                    foreach($arr as $key => $value)
                    {
                        echo '<div style="display: flex; width: 1220px; height: 20px; border: 1px black solid;">
                        <div style="width: 4%; padding-left: 5px; outline: 1px black solid;">' . $key . '</div>
                        <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">' . $value[0] . '</div>
                        <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">' . $value[1] . '</div>
                        <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">' . $value[2] . '</div>
                        <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">' . $value[3] . '</div>
                        <div style="width: 10%; padding-left: 5px; outline: 1px black solid;">' . $value[4] . '</div>
                        <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">' . $value[5] . '</div>
                        <div style="width: 24%; padding-left: 5px; outline: 1px black solid;">' . $value[6] . '</div>
                        </div>';
                    } 
                }
                ?>
                <a href="addNewUser.php">Добавить пользователя</a>

            </section>
        </main>
    </body>
</html>
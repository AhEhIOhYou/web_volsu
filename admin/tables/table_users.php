<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>AutoTrain | Admin | Users</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Администрирование</h1>    
                    
                    <?php 

                    session_start();
                    $tableName = 'users_data';
                    $_SESSION['table'] = $tableName;

                    echo "<h1>Пользователи</h1>";

                    try {
                        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }
        
                    ?>
                    <div style="display: flex; width: 1000px; height: 20px; border: 1px black solid;">
                        <div style="width: 4%; padding-left: 5px; outline: 1px black solid;">ID</div>
                        <div style="width: 14%; padding-left: 5px; outline: 1px black solid;">Имя</div>
                        <div style="width: 14%; padding-left: 5px; outline: 1px black solid;">Фамилия</div>
                        <div style="width: 14%; padding-left: 5px; outline: 1px black solid;">Почта</div>
                        <div style="width: 14%; padding-left: 5px; outline: 1px black solid;">Телефон</div>
                        <div style="width: 14%; padding-left: 5px; outline: 1px black solid;">Возраст</div>
                        <div style="width: 14%; padding-left: 5px; outline: 1px black solid;">Логин</div>
                        <div style="width: 14%; padding-left: 5px; outline: 1px black solid;">Пароль</div>
                    </div>
                        
                    <?php
                    $users = $db->query("SELECT * from $tableName");                        
                            
                        while($row = $users->fetch(PDO::FETCH_BOTH))
                        {
                            $id = array_shift($row);
                            //немного намудрили с расстановкой строк
                            $arr[$id] = array($row[2], $row[3], $row[8], $row[7], $row[5], $row[4], $row[6]);
                        }
                            
                        foreach($arr as $key => $value)
                        {
        
                            echo '<div style="display: flex; width: 1220px; height: 20px; border: 1px black solid;">
                            <div style="width: 4%; padding-left: 5px; outline: 1px black solid;">' . $key . '</div>';
                                
                            for ($i = 0; $i < count($value); $i++) {
                                echo '<div style="width: 14%; padding-left: 5px; outline: 1px black solid;">' . $value[$i] . '</div>';
                            }

                            echo '<form method="POST" action="../edit/edit_users.php">
                                    <button style="width: 120px;" value="' . $key . '" name="id">Редактировать</button>    
                            </form>
                            <form method="POST" action="../delete/delete.php">
                                <button style="width: 100px;" value="' . $key . '" name="id">Удалить</button>    
                            </form>
                            </div>';
                        } 

                        echo '<div><a href="../addNewData.php">Добавить пользователя</a></div>';
                    ?>
                <h3><a href="../main.php">Назад   </a></h3>
            </secion>
        </main>
    </body>
</html>
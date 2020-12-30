<?php
    session_start();
    if (($_SESSION['admin'] != true)) {
        header('Location: ../../index.php');
    }
?>
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

                    $tableName = 'user_list';
                    $_SESSION['table'] = $tableName;

                    echo "<h1>Пользователи</h1>";

                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }
        
                    ?>
                    <div style="display: flex; width: 1000px; height: 20px; border: 1px black solid;">
                        <div style="width: 4%; padding-left: 5px; outline: 1px black solid;">ID</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Имя</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Фамилия</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Почта</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Логин</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Тип</div>
                    </div>
                        
                    <?php
                    $users = $db->query("SELECT * from $tableName");                        
                            
                        while($row = $users->fetch(PDO::FETCH_BOTH))
                        {
                            $id = array_shift($row);
                            //немного намудрили с расстановкой строк
                            $arr[$id] = array($row[1], $row[2], $row[5], $row[3], $row[6]);
                        }
                        if (empty($arr)) :
                            echo '<h3>Пользователей нет</h3>';
                        else :
                            
                        foreach($arr as $key => $value) :?>        
                            <div style="display: flex; width: 1220px; height: 20px; border: 1px black solid;">
                                <div style="width: 4%; padding-left: 5px; outline: 1px black solid;"><?php echo $key; ?></div>

                                <?php for ($i = 0; $i < count($value); $i++) :
                                    if ($i == 4) :
                                        if ($value[$i] == 1) : ?>
                                            <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Админ</div>
                                        <?php else : ?>
                                            <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Дефолтный</div>
                                    <?php endif; else : ?>
                                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $value[$i]; ?></div>
                                    <?php endif;
                                    endfor; ?>

                                <form method="POST" action="../edit/edit_users.php">
                                    <button style="width: 120px;" value="<?php echo $key; ?>" name="id">Редактировать</button>    
                                </form>
                                <form method="POST" action="../delete/delete.php">
                                    <button style="width: 100px;" value="<?php echo $key; ?>" name="id">Удалить</button>    
                                </form>
                            </div>
                        <?php endforeach; 
                        endif; ?>
                        <div><a href="../addNewData.php">Добавить пользователя</a></div>
                <h3><a href="../main.php">Назад   </a></h3>
            </secion>
        </main>
    </body>
</html>
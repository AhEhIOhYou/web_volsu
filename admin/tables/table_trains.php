<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>AutoTrain | Admin | Trains</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Администрирование</h1>    
                    
                    <?php 

                    session_start();
                    $tableName = 'train_list';
                    $_SESSION['table'] = $tableName;

                    echo "<h1>Пользователи</h1>";

                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }
        
                    ?>
                    <div style="display: flex; width: 400px; height: 20px; border: 1px black solid;">
                        <div style="width: 10%; padding-left: 5px; outline: 1px black solid;">ID</div>
                        <div style="width: 30%; padding-left: 5px; outline: 1px black solid;">Номер</div>
                        <div style="width: 60%; padding-left: 5px; outline: 1px black solid;">Тип</div>
                    </div>
                        
                    <?php
                    $users = $db->query("SELECT * from $tableName");                        
                            
                        while($row = $users->fetch(PDO::FETCH_BOTH))
                        {
                            $id = array_shift($row);
                            
                            $arr[$id] = array($row[1],$row[2]);
                        }
                        if (empty($arr)) {
                            echo '<h3>Поездов нет</h3>';
                        } else {
                            
                        foreach($arr as $key => $value)
                        {
        
                            echo '<div style="display: flex; width: 620px; height: 20px; border: 1px black solid;">
                            <div style="width: 10%; padding-left: 5px; outline: 1px black solid;">' . $key . '</div>
                            <div style="width: 30%; padding-left: 5px; outline: 1px black solid;">' . $value[1] . '</div>';

                            if ($value[0] == 1) {
                                echo '<div style="width: 60%; padding-left: 5px; outline: 1px black solid;">СКОРОСТНОЙ</div>';
                            } else {
                                echo '<div style="width: 60%; padding-left: 5px; outline: 1px black solid;">ОБЫЧНЫЙ</div>';
                            }

                            echo '<form method="POST" action="../edit/edit_train.php">
                                    <button style="width: 120px;" value="' . $key . '" name="id">Редактировать</button>    
                            </form>
                            <form method="POST" action="../delete/delete.php">
                                <button style="width: 100px;" value="' . $key . '" name="id">Удалить</button>    
                            </form>
                            </div>';
                        } 
                    }

                        echo '<div><a href="../addNewData.php">Добавить поезд</a></div>';
                    ?>
                <h3><a href="../main.php">Назад   </a></h3>
            </secion>
        </main>
    </body>
</html>
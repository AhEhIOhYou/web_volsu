<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>AutoTrain | Admin | Trips</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Администрирование</h1>    
                    
                    <?php 

                    session_start();
                    $tableName = 'trip_list';
                    $_SESSION['table'] = $tableName;

                    echo "<h1>Рейсы</h1>";
                        
                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    } ?>


                    <div style="display: flex; width: 1000px; height: 20px; border: 1px black solid;">
                        <div style="width: 4%; padding-left: 5px; outline: 1px black solid;">ID</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Откуда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время отправления</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Куда</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время прибытия</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Дата</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Цена</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Поезд</div>
                    </div>

                    <?php

                    $trips = $db->query("SELECT * from $tableName");
                                             
                    while($row = $trips->fetch(PDO::FETCH_BOTH)) 
                    {
                        $id = array_shift($row);
                        $arr[$id] = array($row[1],$row[3],$row[2],$row[4],$row[6],$row[5],$row[7]);
                    }
                
                    foreach($arr as $key => $value)
                    {
                        echo '<div style="display: flex; width: 1220px; height: 20px; border: 1px black solid;">
                        <div style="width: 4%; padding-left: 5px; outline: 1px black solid;">' . $key . '</div>';
                        for ($i = 0; $i < count($value); $i++) {
                            echo '<div style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $value[$i] . '</div>';
                        }

                        echo '<form method="POST" action="../edit/edit_trains.php">
                                <button style="width: 120px;" value="' . $key . '" name="id">Редактировать</button>    
                              </form>
                                <form method="POST" action="../delete/delete.php">
                                    <button style="width: 100px;" value="' . $key . '" name="id">Удалить</button>    
                                </form>
                        </div>';
                        } 

                        echo '<div><a href="../addNewData.php">Добавить рейс</a></div>';
                    ?>
                <h3><a href="../main.php">Назад   </a></h3>
            </secion>
        </main>
    </body>
</html>
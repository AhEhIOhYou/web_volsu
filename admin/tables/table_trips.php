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
        <title>AutoTrain | Admin | Trips</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Администрирование</h1>    
                    
                    <?php 

                    $tableName = 'trip_list';
                    $_SESSION['table'] = $tableName;

                    if (isset($_GET['trip_id'])) {
                        $ch_id = $_GET['trip_id'];
                    } else {
                        $ch_id = -1;
                    }

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

                    if (empty($arr)) :
                        echo '<h3>Рейсов нет</h3>';
                    else :
                    foreach($arr as $key => $value) : ?>
                        <div style="display: flex; width: 1220px; height: 20px; border: 1px black solid;">
                            <?php if ($key == $ch_id) :?>
                                <div style="width: 4%; padding-left: 5px; outline: 3px red solid;"><?php echo $key; ?></div>
                            <?php else :?>
                                <div style="width: 4%; padding-left: 5px; outline: 1px black solid;"><?php echo $key; ?></div>
                            <?php endif;?>
                            
                            <?php for ($i = 0; $i < count($value) - 1; $i++) : ?>
                                <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $value[$i]; ?></div>
                            <?php endfor; ?>

                            <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><a href="table_trains.php?train_id=<?php echo $value[6]; ?>"><?php echo $value[6]; ?></a></div>

                            <form method="POST" action="../edit/edit_trips.php">
                                <button style="width: 120px;" value="<?php echo $key; ?>" name="id">Редактировать</button>    
                            </form>
                            <form method="POST" action="../delete/delete.php">
                                <button style="width: 100px;" value="<?php echo $key; ?>" name="id">Удалить</button>    
                            </form>
                        </div>
                        <?php endforeach;
                    endif; ?>
                        <div><a href="../addNewData.php">Добавить рейс</a></div>
                <h3><a href="../main.php">Назад   </a></h3>
            </secion>
        </main>
    </body>
</html>
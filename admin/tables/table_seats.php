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
        <title>AutoTrain | Admin | Seats</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Администрирование</h1>    
                    
                    <?php 

                    $tableName = 'seats_list';
                    $_SESSION['table'] = $tableName;
                    
                    if (isset($_GET['seat_id'])) {
                        $ch_id = $_GET['seat_id'];
                    } else {
                        $ch_id = -1;
                    }

                    echo "<h1>Места</h1>";

                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }
        
                    ?>
                    <div style="display: flex; width: 780px; height: 20px; border: 1px black solid;">
                        <div style="width: 4%; padding-left: 5px; outline: 1px black solid;">ID</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id поезда</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">Собст. номер</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">Состояние</div>
                    </div>
                        
                    <?php
                    $seats = $db->query("SELECT * from $tableName");                        
                            
                        while($row = $seats->fetch(PDO::FETCH_BOTH))
                        {
                            $id = array_shift($row);
                            
                            $arr[$id] = array($row[1], $row[2], $row[3]);
                        }
                        
                        if (empty($arr)) :
                            echo '<h3>Мест нет</h3>';
                        else :
                            
                        foreach($arr as $key => $value) : ?>
        
                            <div style="display: flex; width: 1000px; height: 20px; border: 1px black solid;">
                                <?php if ($key == $ch_id) : ?>
                                    <div style="width: 4%; padding-left: 5px; outline: 3px red solid;"><?php echo $key; ?></div>
                                <?php else : ?>
                                    <div style="width: 4%; padding-left: 5px; outline: 1px black solid;"><?php echo $key; ?></div>
                                <?php endif; ?>

                            <?php for ($i = 0; $i < count($value); $i++) :
                                if ($i == 2) {
                                    if ($value[$i] == 0) { ?>
                                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">Свободно - 0</div>
                                    <?php } else { ?>
                                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">Занято - 1</div>
                                    <?php }} elseif ($i == 0) { ?>
                                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><a href="table_trains.php?train_id=<?php echo $value[$i]; ?>"><?php echo $value[$i]; ?></a></div>
                                    <?php } else { ?>
                                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><?php echo $value[$i]; ?></div>
                                    <?php }
                            endfor; ?>

                                <form method="POST" action="../edit/edit_seat.php">
                                    <button style="width: 120px;" value="<?php echo $key; ?>" name="id">Редактировать</button>    
                                </form>
                                <form method="POST" action="../delete/delete.php">
                                    <button style="width: 100px;" value="<?php echo $key; ?>" name="id">Удалить</button>    
                                </form>
                            </div>
                        <?php endforeach; endif; ?>

                        <div><a href="../addNewData.php">Добавить место</a></div>
                <h3><a href="../main.php">Назад   </a></h3>
            </secion>
        </main>
    </body>
</html>

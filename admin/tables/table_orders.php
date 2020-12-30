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
        <title>AutoTrain | Admin | Orders</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Администрирование</h1>    
                    
                    <?php 

                    $tableName = 'order_list';
                    $_SESSION['table'] = $tableName;

                    echo "<h1>Заказы</h1>";

                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }
        
                    ?>
                    <div style="display: flex; width: 580px; height: 20px; border: 1px black solid;">
                        <div style="width: 8%; padding-left: 5px; outline: 1px black solid;">ID</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id рейса</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id места</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id пользователя</div>
                    </div>
                        
                    <?php
                    $orders = $db->query("SELECT * from $tableName");                        
                            
                        while($row = $orders->fetch(PDO::FETCH_BOTH))
                        {
                            $id = array_shift($row);
                            
                            $arr[$id] = array($row[1], $row[2], $row[3]);
                        }

                        if (empty($arr)) :
                            echo '<h3>Заказов нет</h3>';
                        else :
                            
                        foreach($arr as $key => $value) :?>        
                            <div style="display: flex; width: 800px; height: 20px; border: 1px black solid;">
                                <div style="width: 8%; padding-left: 5px; outline: 1px black solid;"><?php echo $key; ?></div>
                                
                                <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><a href="table_trips.php?trip_id=<?php echo $value[0]; ?>"><?php echo $value[0]; ?></a></div>
                                <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><a href="table_seats.php?seat_id=<?php echo $value[1]; ?>"><?php echo $value[1]; ?></a></div>
                                <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><a href="table_users.php?user_id=<?php echo $value[2]; ?>"><?php echo $value[2]; ?></a></div>
                                

                                <form method="POST" action="../edit/edit_order.php">
                                    <button style="width: 120px;" value="<?php echo $key; ?>" name="id">Редактировать</button>    
                                </form>
                                <form method="POST" action="../delete/order.php">
                                    <button style="width: 100px;" value="<?php echo $key; ?>" name="id">Удалить</button>    
                                </form>
                            </div>
                        <?php endforeach;
                    endif ?>
                    
                    <div><a href="../addNewData.php">Добавить заказ</a></div>
                <h3><a href="../main.php">Назад   </a></h3>
            </secion>
        </main>
    </body>
</html>
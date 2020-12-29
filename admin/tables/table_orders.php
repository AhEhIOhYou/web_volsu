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

                    session_start();
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
                    $users = $db->query("SELECT * from $tableName");                        
                            
                        while($row = $users->fetch(PDO::FETCH_BOTH))
                        {
                            $id = array_shift($row);
                            
                            $arr[$id] = array($row[1], $row[2], $row[3]);
                        }

                        if (empty($arr)) {
                            echo '<h3>Заказов нет</h3>';
                        } else {
                            
                        foreach($arr as $key => $value)
                        {
        
                            echo '<div style="display: flex; width: 800px; height: 20px; border: 1px black solid;">
                            <div style="width: 8%; padding-left: 5px; outline: 1px black solid;">' . $key . '</div>';

                            for ($i = 0; $i < count($value); $i++) {
                                echo '<div style="width: 40%; padding-left: 5px; outline: 1px black solid;">' . $value[$i] . '</div>';
                            }

                            echo '<form method="POST" action="../edit/edit_order.php">
                                    <button style="width: 120px;" value="' . $key . '" name="id">Редактировать</button>    
                            </form>
                            <form method="POST" action="../delete/order.php">
                                <button style="width: 100px;" value="' . $key . '" name="id">Удалить</button>    
                            </form>
                            </div>';
                        } 
                    }
                        echo '<div><a href="../addNewData.php">Добавить заказ</a></div>';
                    
                    ?>
                <h3><a href="../main.php">Назад   </a></h3>
            </secion>
        </main>
    </body>
</html>
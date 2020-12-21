<!DOCTYPE html>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="m_styles.css">
        <meta charset="utf-8">
        <title>AutoTrain | Admin | Orders</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Администрирование</h1>    
                    
                    <?php 

                    session_start();
                    $tableName = 'orders';
                    $_SESSION['table'] = $tableName;

                    echo "<h1>Заказы</h1>";
                        
                    try {
                        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    } ?>


                    <div style="display: flex; width: 340px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">id</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id поезда</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id пользователя</div>
                    </div>

                    <?php

                    $tabldata = $db->query("SELECT * from $tableName");
                                             
                    while($row = $tabldata->fetch(PDO::FETCH_BOTH)) 
                    {
                        $id = array_shift($row);
                        $arr[$id] = array($row[1],$row[2]);
                    }
                
                    foreach($arr as $key => $value)
                    {
                        echo '<div style="display: flex; width: 560px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">' . $key . '</div>';
                        for ($i = 0; $i < count($value); $i++) {
                            echo '<div style="width: 40%; padding-left: 5px; outline: 1px black solid;">' . $value[$i] . '</div>';
                        }

                        echo '<form method="POST" action="../edit/edit_orders.php">
                                <button style="width: 120px;" value="' . $key . '" name="id">Редактировать</button>    
                              </form>
                                <form method="POST" action="../delete/delete.php">
                                    <button style="width: 100px;" value="' . $key . '" name="id">Удалить</button>    
                                </form>
                        </div>';
                        } 

                        echo '<div><a href="../addNewData.php">Добавить закааз</a></div>';
                    ?>
                <h3><a href="../main.php">Назад</a></h3>
            </secion>
        </main>
    </body>
</html>
<?php
    session_start();
    if (($_SESSION['admin'] != true)) {
        header('Location: ../index.php');
    }
?>
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

                    $tableName = 'orders';
                    $_SESSION['table'] = $tableName;

                    echo "<h1>Заказы</h1>";
                        
                    try {
                        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    } 
                      
                    //запрашиваем и выводим (если не пустой) список всех данных из соответсвующей таблицы
                    $tabldata = $db->query("SELECT * from $tableName");
                                             
                    while($row = $tabldata->fetch(PDO::FETCH_BOTH)) 
                    {
                        $id = array_shift($row);
                        $arr[$id] = array($row[1],$row[2]);
                    } 
                    $is_or = $db->query("SELECT count(`id`) FROM $tableName ");
                    $check = $is_or->fetchColumn();

                    if ($check < 1) {
                        echo '<h3>Заказов нет!</h3>';
                    } else {
                    ?>

                    <div style="display: flex; width: 340px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">id</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id рейса</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id пользователя</div>
                    </div>

                        <?php foreach($arr as $key => $value) : ?>

                        <div style="display: flex; width: 560px; height: 20px; border: 1px black solid;">
                            <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $key; ?></div>
                            
                            <?php for ($i = 0; $i < count($value); $i++) : ?>
                                <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><?php echo $value[$i]; ?></div>
                            <?php endfor; ?>

                            <form method="POST" action="../edit/edit_orders.php">
                                <button style="width: 120px;" value="<?php echo $key; ?>" name="id">Редактировать</button>    
                            </form>
                            <form method="POST" action="../delete/delete.php">
                                <button style="width: 100px;" value="<?php echo $key; ?>" name="id">Удалить</button>    
                            </form>
                        </div>
                    <?php endforeach; 
                    }?>

                        <div><a href="../addNewData.php">Добавить закааз</a></div>
                <h3><a href="../main.php">Назад</a></h3>
            </secion>
        </main>
    </body>
</html>
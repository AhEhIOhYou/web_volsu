<?php 
    $id = $_POST['id'];
    if (!isset($id)) {
        header('Location: ../main.php');
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>AutoTrain | Admin</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Редактирование</h1>


                <?php
                $tableName = 'trips_data';
                try {
                    $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
                } catch (PDOException $e) {
                    print "Ошибка подключпения к БД!: " . $e->getMessage();
                    die();
                }

                    $trains = $db->prepare("SELECT * FROM $tableName WHERE `id` = ?");
                    $trains->execute([$id]);
                    while($row = $trains->fetch(PDO::FETCH_ASSOC)) {
                        $id = array_shift($row);
                        $arr = array($row);
                    }
   
                    foreach($arr as $key => $row) {

                    ?>


                
                <h1>Поезд номер: <?php echo $id; ?></h1>
                <div style="display: flex; width: 1000px; height: 20px; border: 1px black solid;">
                    <div style="width: 4%; padding-left: 5px; outline: 1px black solid;">ID</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Откуда</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время отправления</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Куда</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Время прибытия</div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Цена</div>
                </div>

                <div style="display: flex; width: 1000px; height: 20px; border: 1px black solid;">
                    <div style="width: 4%; padding-left: 5px; outline: 1px black solid;"><?php echo $id; ?></div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['place_from']; ?></div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['time_from']; ?></div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['place_to']; ?></div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['time_to']; ?></div>
                    <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['price']; ?></div>
                </div>


                <?php }?>


                <p>Введите новые данные:</p>
                <form method="POST" action="change.php" class="reg-form">
                    <input type="text" name="n_place_from" placeholder="Откуда">
                    <input type="text" name="n_palce_to" placeholder="Время отправления">
                    <input type="text" name="n_time_from" placeholder="Куда">
                    <input type="text" name="n_time_to" placeholder="Время прибытия">
                    <input type="number" name="n_price" placeholder="Цена">
                    <button type="submit" name="id" value="<?php echo $id; ?>">Изменить</button>
                </form> 

                <h3><a href="../main.php">Отмена</a></h3>

            </section>
        </main>
    </body>
</html>
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
                $tableName = 'orders';
                try {
                    $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
                } catch (PDOException $e) {
                    print "Ошибка подключпения к БД!: " . $e->getMessage();
                    die();
                }

                    $orders = $db->prepare("SELECT * FROM $tableName WHERE `id` = ?");
                    $orders->execute([$id]);
                    while($row = $orders->fetch(PDO::FETCH_ASSOC)) {
                        $id = array_shift($row);
                        $arr = array($row);
                    }
   
                    foreach($arr as $key => $row) {

                    ?>


                
                <h1>Поезд номер: <?php echo $id; ?></h1>
                <div style="display: flex; width: 340px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">id</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id пользователя</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id поезда</div>
    
                    </div>

                    <div style="display: flex; width: 340px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $id; ?></div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['user_id']; ?></div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['train_id']; ?></div>
                    </div>


                <?php }?>


                <p>Введите новые данные:</p>
                <form method="POST" action="change.php" class="reg-form">
                    <input type="number" name="n_id_user" placeholder="id пользователя">
                    <input type="number" name="n_id_train" placeholder="id заказа">
                    <button type="submit" name="id" value="<?php echo $id; ?>">Изменить</button>
                </form> 

                <h3><a href="../main.php">Отмена</a></h3>

            </section>
        </main>
    </body>
</html>
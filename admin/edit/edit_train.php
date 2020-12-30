<?php 
    $id = $_POST['id'];
    if (!isset($id)) {
        header('Location: ../main.php');
    }
    session_start();
    if (($_SESSION['admin'] != true)) {
        header('Location: ../../index.php');
    }
    require_once '../../log.php';
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -edit_train.php-');
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
                $tableName = 'train_list';
                try {
                    $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
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


                
                <h1>Поезд: <?php echo $id; ?></h1>
                <div style="display: flex; width: 340px; height: 20px; border: 1px black solid;">
                        <div style="width: 10%; padding-left: 5px; outline: 1px black solid;">id</div>
                        <div style="width: 60%; padding-left: 5px; outline: 1px black solid;">Тип</div>
                        <div style="width: 30%; padding-left: 5px; outline: 1px black solid;">Номер</div>
    
                    </div>

                    <div style="display: flex; width: 340px; height: 20px; border: 1px black solid;">
                        <div style="width: 10%; padding-left: 5px; outline: 1px black solid;"><?php echo $id; ?></div>
                        <div style="width: 60%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['type']; ?></div>
                        <div style="width: 30%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['number']; ?></div>
                    </div>


                <?php }?>


                <p>Введите новые данные:</p>
                <form method="POST" action="change.php" class="reg-form">
                    <input type="number" name="n_type" placeholder="Тип">
                    <input type="number" name="n_number" placeholder="Номер">
                    <button type="submit" name="id" value="<?php echo $id; ?>">Изменить</button>
                </form> 

                <h3><a href="../main.php">Отмена</a></h3>

            </section>
        </main>
    </body>
</html>
<?php 
    $id = $_POST['id'];
    if (!isset($id)) {
        header('Location: ../main.php');
    }
    session_start();
    if (($_SESSION['admin'] != true)) {
        header('Location: ../../index.php');
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
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">id рейса</div>
                    </div>

                    <div style="display: flex; width: 340px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $id; ?></div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['user_id']; ?></div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['trip_id']; ?></div>
                    </div>


                <?php }?>


                <p>Введите новые данные:</p>
                <div style="display: flex; width: 240px; height: 20px; border: 1px black solid;">
                        <div style="width: 50%; padding-left: 5px; outline: 1px black solid;">id пользователя</div>
                        <div style="width: 50%; padding-left: 5px; outline: 1px black solid;">id рейса</div>
                    </div>
                <form method="POST" action="change.php" class="reg-form">
                    <select  name="n_id_user">
                            <?php
                            $f_all = $db->query("SELECT `id` FROM `users_data`");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>
                    <select  name="n_trip_id">
                            <?php
                            $f_all = $db->query("SELECT `id` FROM `trips_data`");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>
                    <button type="submit" name="id" value="<?php echo $id; ?>">Изменить</button>
                </form> 

                <h3><a href="../main.php">Отмена</a></h3>

            </section>
        </main>
    </body>
</html>
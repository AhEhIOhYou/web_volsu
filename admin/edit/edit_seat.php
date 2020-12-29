<?php 
    $id = $_POST['id'];
    if (!isset($id)) {
        header('Location: ../main.php');
    }
    session_start();
    require_once '../../log.php';
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -edit_seat.php-');
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
                $tableName = 'seats_list';
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


                
                <h1>Место номер: <?php echo $id; ?></h1>
                <div style="display: flex; width: 440px; height: 20px; border: 1px black solid;">
                        <div style="width: 10%; padding-left: 5px; outline: 1px black solid;">id</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">id поезда</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">номер места</div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">состояние</div>
    
                    </div>

                    <div style="display: flex; width: 440px; height: 20px; border: 1px black solid;">
                        <div style="width: 10%; padding-left: 5px; outline: 1px black solid;"><?php echo $id; ?></div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['train_id']; ?></div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['number']; ?></div>
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['state']; ?></div>
                    </div>


                <?php }?>


                <p>Введите новые данные:</p>
                <form method="POST" action="change.php" class="reg-form">
                    <select  name="n_train_id">
                            <?php
                            $f_all = $db->query("SELECT `id` FROM `train_list`");
                            $arr_s = array(); 
                            while ($arr_s = $f_all->fetch(PDO::FETCH_NUM)) {
                                foreach ($arr_s as $val): ?> 
                                    <option style="width: 100px; padding-left: 5px;"><?php echo $val ?></option>
                                <?php endforeach;
                            }?>
                    </select>
                    <input type="number" name="n_number" placeholder="номер">
                    <input type="number" name="n_state" placeholder="состояние">
                    <button type="submit" name="id" value="<?php echo $id; ?>">Изменить</button>
                </form> 

                <h3><a href="../main.php">Отмена</a></h3>

            </section>
        </main>
    </body>
</html>
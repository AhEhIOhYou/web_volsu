<?php 
    $id = $_POST['id'];
    if (!isset($id)) {
        header('Location: ../main.php');
    }
    session_start();
    require_once '../../log.php';
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -edit_covid.php-');
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
                $tableName = 'quarantine_data';
                try {
                    $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                } catch (PDOException $e) {
                    print "Ошибка подключпения к БД!: " . $e->getMessage();
                    die();
                }

                    $orders = $db->prepare("SELECT * FROM $tableName WHERE `city_name` = ?");
                    $orders->execute([$id]);
                    while($row = $orders->fetch(PDO::FETCH_ASSOC)) {
                        $id = array_shift($row);
                        $arr = array($row);
                    }
   
                    foreach($arr as $key => $row) {

                    ?>

                
                <h1>COVID:</h1>
                <div style="display: flex; width: 340px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Город</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">Инфа</div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">Актуальность</div>
    
                    </div>

                    <div style="display: flex; width: 340px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $id; ?></div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['info']; ?></div>
                        <div style="width: 40%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['relevance']; ?></div>
                    </div>


                <?php }?>


                <p>Введите новые данные:</p>
                <form method="POST" action="change.php" class="reg-form">
                    <input type="text" name="n_info" placeholder="Информация">
                    <input type="number" name="n_relevance" placeholder="актуальность">
                    <button type="submit" name="id" value="<?php echo $id; ?>">Изменить</button>
                </form> 

                <h3><a href="../main.php">Отмена</a></h3>

            </section>
        </main>
    </body>
</html>
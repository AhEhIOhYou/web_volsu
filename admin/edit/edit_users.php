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
    my_log('Пользователь id = ' . $_SESSION['user'] . ' на странице -edit_users.php-');
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
                $tableName = 'user_list';
                try {
                    $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                } catch (PDOException $e) {
                    print "Ошибка подключпения к БД!: " . $e->getMessage();
                    die();
                }

                    $users = $db->prepare("SELECT * FROM $tableName WHERE `id` = ?");
                    $users->execute([$id]);
                    while($row = $users->fetch(PDO::FETCH_ASSOC)) {
                        $id = array_shift($row);
                        $arr = array($row);
                    }
   
                    foreach($arr as $key => $row) {

                    ?>


                
                <h1>Пользователь: <?php echo $row['login']; ?></h1>
                <div style="display: flex; width: 1000px; height: 20px; border: 1px black solid;">
                    <div style="width: 4%; padding-left: 5px; outline: 1px black solid;">ID</div>
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;">Имя</div>
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;">Фамилия</div>
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;">Почта</div>
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;">Логин</div>
                </div>

                <div style="display: flex; width: 1000px; height: 20px; border: 1px black solid;">
                    <div style="width: 4%; padding-left: 5px; outline: 1px black solid;"><?php echo $id; ?></div>
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['name']; ?></div>
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['surname']; ?></div>
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['email']; ?></div>
                    <div style="width: 25%; padding-left: 5px; outline: 1px black solid;"><?php echo $row['login']; ?></div>
                </div>


                <?php }?>


                <p>Введите новые данные:</p>
                <form method="POST" action="change.php" class="reg-form">

                    <input type="text" name="n_name" placeholder="Имя">
                    <input type="text" name="n_surname" placeholder="Фамилия">
                    <input type="email" name="n_email" placeholder="Почта">
                    <input type="text" name="n_login" placeholder="Логин">
                    <button type="submit" name="id" value="<?php echo $id; ?>">Изменить</button>

                </form>
                <h3><a href="../main.php">Отмена</a></h3>

            </section>
        </main>
    </body>
</html>
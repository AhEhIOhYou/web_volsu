<?php 
    session_start();
    unset($_SESSION['table']);
    if(!isset($_SESSION['user'])) {
        header('Location:  /user/lk.login.php');
    }

    $id_train = $_POST['key'];
    $id_user = $_SESSION['user'];

    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }
    
    $isorder = $db->query("SELECT COUNT(`train_id`) as count FROM `orders` 
                        WHERE `user_id` = $id_user AND `train_id` = $id_train")->fetchColumn();

    if ($isorder > 0) {
        echo '<h1>Билет уже был вами приобретен</h1>';
        echo '<a href="trainList.php">К списку</a>';
    } else {

        $db->prepare("INSERT INTO `orders` (`user_id`,`train_id`)
                        VALUES(?, ?)")->execute([$id_user, $id_train]);
    

        echo "<h1>Успешно!</h1>";
        echo '<a href="/index.php">На главную</a>';
    }
?>
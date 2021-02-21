<?php 
    session_start();
    unset($_SESSION['table']);
    if(!isset($_SESSION['user'])) {
        header('Location:  /user/lk.login.php');
    }
    //получаем id пользователя, и id рейса
    $trip_id = $_POST['id_trip'];
    $user = $_SESSION['user'];

    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    //если уже существует такая покупка, то отменяем повторное приобретение
    $is_or = $db->prepare("SELECT COUNT(`id`) as count FROM `orders` WHERE `user_id` = ? AND `trip_id` = ?");
    $is_or->execute([$user,$trip_id]);
    $is_orders = $is_or->fetchColumn();
    

    if ($is_orders > 0) {
        echo '<h1>Билет уже был вами приобретен</h1>';
        echo '<a href="trainList.php">К списку</a>';
    } else {
        //инчае составляем запись покупки рейса
        $db->prepare("INSERT INTO `orders` (`trip_id`,`user_id`) VALUES(?, ?)")->execute([$trip_id, $user]);
    
        echo "<h1>Успешно!</h1>";
        echo '<a href="/index.php">На главную</a>';
    }
?>
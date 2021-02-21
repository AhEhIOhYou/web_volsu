<?php
    session_start();
    $user = $_SESSION['user'];
    $trip_id = $_POST['key'];

    try {
        $db = new PDO('mysql:host=localhost;dbname=big_data', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }
    //удаляем запись по id пользоваателя и выбранному рейсу
    //можно было извлечь id удаляемой записи и удалить по нему, но повторные покупки запрещены
    //поэтому таким способом мы по-любому удалим нужный заказ
    $db->prepare("DELETE FROM `orders` WHERE `trip_id` = ? AND `user_id` = ?")->execute([$trip_id, $user]);
    
    echo "<h1>Успешно!</h1>";
    echo '<a href="user/lk.index.php">В личный кабинет</a>';
?>
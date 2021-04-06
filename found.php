<?php
    session_start();
    $stPlace = $_POST['stPlace'];
    $endPlace = $_POST['endPlace'];

    if(isset($_SESSION['train-id'])) {
        unset($_SESSION['train-id']);
    }

    try {
        $db = new PDO('mysql:host=localhost;dbname=users', 'root', '');
    } catch (PDOException $e) {
        print "Ошибка подключпения к БД!: " . $e->getMessage();
        die();
    }

    $usedata = $db->query("SELECT `id` FROM `train_list` WHERE `startPlace` = '$stPlace' AND `endPlace` = '$endPlace'");
    
    while($row = $usedata->fetch(PDO::FETCH_ASSOC)) {
        $trainId =  $row['id'];
    }


    if(isset($trainId)) {
        $_SESSION['train-id'] = $trainId;
    }

    header ('Location: list.php');
?>

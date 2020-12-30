<?php
    session_start();
    if (($_SESSION['admin'] != true)) {
        header('Location: ../../index.php');
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>AutoTrain | Admin | Cities</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Администрирование</h1>    
                    
                    <?php 

                    $tableName = 'city_data';
                    $_SESSION['table'] = $tableName;

                    if (isset($_GET['city_name'])) {
                        $ch_id = $_GET['city_name'];
                    } else {
                        $ch_id = -1;
                    }

                    echo "<h1>Города</h1>";

                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }
        
                    ?>
                    <div style="display: flex; width: 400px; height: 20px; border: 1px black solid;">
                        <div style="width: 10%; padding-left: 5px; outline: 1px black solid;">ID</div>
                        <div style="width: 90%; padding-left: 5px; outline: 1px black solid;">Название</div>
                    </div>
                        
                    <?php
                    $cities = $db->query("SELECT * from $tableName");                        
                            
                        while($row = $cities->fetch(PDO::FETCH_BOTH))
                        {
                            $id = array_shift($row);
                            
                            $arr[$id] = array($row[1]);
                        }

                        if (empty($arr)) :
                            echo '<h3>Городов нет</h3>';
                        else :
                        foreach($arr as $key => $value) : ?>
        
                            <div style="display: flex; width: 620px; height: 20px; border: 1px black solid;">
                                <div style="width: 10%; padding-left: 5px; outline: 1px black solid;"><?php echo $key; ?></div>
                                <?php if ($value[0] == $ch_id) :?> 
                                    <div style="width: 90%; padding-left: 5px; outline: 3px red solid;"><?php echo $value[0]; ?></div>
                                <?php else : ?>
                                <div style="width: 90%; padding-left: 5px; outline: 1px black solid;"><?php echo $value[0]; ?></div>
                                <?php endif; ?>
                                <form method="POST" action="../edit/edit_city.php">
                                    <button style="width: 120px;" value="<?php echo $key; ?>" name="id">Редактировать</button>    
                                </form>
                                <form method="POST" action="../delete/delete.php">
                                    <button style="width: 100px;" value="<?php echo $key; ?>" name="id">Удалить</button>    
                                </form>
                            </div>
                        <?php endforeach;
                        endif; ?>
                
                    <div><a href="../addNewData.php">Добавить город</a></div>
                <h3><a href="../main.php">Назад   </a></h3>
            </secion>
        </main>
    </body>
</html>
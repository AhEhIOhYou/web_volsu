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
        <title>AutoTrain | Admin | Weather</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Администрирование</h1>    
                    
                    <?php 

                    $tableName = 'weather_data';
                    $_SESSION['table'] = $tableName;

                    echo "<h1>Погода</h1>";

                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }
        
                    ?>
                    <div style="display: flex; width: 400px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">Город</div>
                        <div style="width: 80%; padding-left: 5px; outline: 1px black solid;">Погода</div>
                    </div>
                        
                    <?php
                    $weth = $db->query("SELECT * from $tableName");                        
                            
                        while($row = $weth->fetch(PDO::FETCH_BOTH))
                        {
                            $id = array_shift($row);
                            
                            $arr[$id] = array($row[1]);
                        }
                        if (empty($arr)) :
                            echo '<h3>Информации нет</h3>';
                        else :
                            
                        foreach($arr as $key => $value) : ?>
        
                            <div style="display: flex; width: 620px; height: 20px; border: 1px black solid;">
                                <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $key; ?></div>
                                <div style="width: 80%; padding-left: 5px; outline: 1px black solid;"><?php echo $value[0]; ?></div>

                                <form method="POST" action="../edit/edit_weth.php">
                                    <button style="width: 120px;" value="<?php echo $key; ?>" name="id">Редактировать</button>    
                                </form>
                                <form method="POST" action="../delete/delete.php">
                                    <button style="width: 100px;" value="<?php echo $key; ?>'" name="id">Удалить</button>    
                                </form>
                            </div>
                    <?php endforeach;
                    endif; ?>
                <h3><a href="../main.php">Назад   </a></h3>
            </secion>
        </main>
    </body>
</html>
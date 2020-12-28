<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>AutoTrain | Admin | Covid</title>
    </head>
    <body>
        <main>
            <section class="main-cont">
                <h1 class="title">Администрирование</h1>    
                    
                    <?php 

                    session_start();
                    $tableName = 'quarantine_data';
                    $_SESSION['table'] = $tableName;

                    echo "<h1>Ситуация с COVID-19</h1>";

                    try {
                        $db = new PDO('mysql:host=localhost;dbname=autotrain_data', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }
        
                    ?>
                    <div style="display: flex; width: 400px; height: 20px; border: 1px black solid;">
                        <div style="width: 20%; padding-left: 5px; outline: 1px black solid;">id города</div>
                        <div style="width: 60%; padding-left: 5px; outline: 1px black solid;">Информация</div>
                        <div style="width: 30%; padding-left: 5px; outline: 1px black solid;">Актуальность</div>
                    </div>
                        
                    <?php
                    $users = $db->query("SELECT * from $tableName");                        
                            
                        while($row = $users->fetch(PDO::FETCH_BOTH))
                        {
                            $id = array_shift($row);
                            
                            $arr[$id] = array($row[1],$row[2]);
                        }
                            
                        foreach($arr as $key => $value) { ?>
        
                            <div style="display: flex; width: 620px; height: 20px; border: 1px black solid;">
                                <div style="width: 20%; padding-left: 5px; outline: 1px black solid;"><?php echo $key;?> </div>

                                <div style="width: 60%; padding-left: 5px; outline: 1px black solid;"><?php echo $value[0]; ?></div>

                                <?php if ($value[1] == 0 ) : ?>
                                    <div style="width: 40%; padding-left: 5px; outline: 1px black solid;">Не актуально - 0</div>
                                <?php  else : ?>
                                    <div style="width: 30%; padding-left: 5px; outline: 1px black solid;">Актуально - 1</div>
                                <?php endif ?>

                                <form method="POST" action="../edit/edit_covid.php">
                                    <button style="width: 120px;" value="<?php echo $key;?>" name="id">Редактировать</button>    
                                </form>

                                <form method="POST" action="../delete/delete.php">
                                    <button style="width: 100px;" value="<?php echo $key;?>" name="id">Удалить</button>    
                                </form>
                            
                            </div>
                        <?php }  ?>
                        
                <h3><a href="../main.php">Назад   </a></h3>
            </secion>
        </main>
    </body>
</html>
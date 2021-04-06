<?php session_start();
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>AutoTrain | Tickets list</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/list.css">
    </head>
    <body>
    <header class="main-header">
                <a class="title-text" href="index.php">TRAIN</a>
                <div class="reg-and-auth">

                    <div class="user-item">
                        <a class="link" href="verification/reg_main.php">
                            Регистрация
                        </a>
                    </div>

                    <?php if (!isset($_SESSION['user'])) : ?>

                    <div class="user-item">
                        <a class="link" href="verification/auth_main.php">
                            Вход
                        </a>
                    </div>

                    <?php else : ?>

                    <div class="user-item">
                        <a class="link" href="verification/lk.index.php">
                            Личный кабнет
                        </a>
                    </div>

                    <?php endif ?>
                </div>
                <p class="after-title-text">Fast, that you think</p>
        </header>

        <main class="main-content">
            <?php
            ?>
            <div class="form-box">
                <form class="main-form" action="found.php" method="POST">
                    <input type="text" class="found-item otkuda" name="stPlace" id="stPlace" placeholder="Откуда">
                    <div class="found-item">
                      <div class="ar arrow-first"></div>
                      <div class="ar arrow-second"></div>
                    </div>
                    <input type="text" class="found-item kuda" placeholder="Куда" name="endPlace" id="endPlae">
                    <input type="date" class="found-item date">
                    <button type="submit" class="found-item search">Go!</button>
                </form>
        </div>
            <section class="main-box"  method="POST">
            <?php if (isset($_SESSION['train-id'])) : ?>
                <?php
                    $trainId = $_SESSION['train-id'];
                     
                     try {
                        $db = new PDO('mysql:host=localhost;dbname=users', 'root', '');
                    } catch (PDOException $e) {
                        print "Ошибка подключпения к БД!: " . $e->getMessage();
                        die();
                    }

                    
                    $usedata = $db->query("SELECT * FROM `train_list` WHERE `id` = '$trainId'");
                

                    while($row = $usedata->fetch(PDO::FETCH_ASSOC)) {
                        $trainName = $row['trainName'];
                        $stPlace = $row['startPlace'];
                        $endPlace = $row['endPlace'];
                        $cost = $row['cost'];
                        $time = $row['timeTavel'];
                        $stData = $row['startData'];
                        $endData = $row['endData'];
                        $stTime = $row['startTime'];
                        $endTime = $row['endTime'];
                        $stStation = $row['startStation'];
                        $endStation = $row['endStation'];
                    }

                     ?>
                <div class="box-item" >
                    <div class="_box-item "><?php print_r($stPlace) ?> - <?php print_r($endPlace) ?></div>
                    <div class="_box-item"><?php print_r($stData) ?><br><?php print_r($stTime) ?><br><?php print_r($stStation) ?></div>
                    <div class="_box-item"><?php print_r($time) ?></div>
                    <div class="_box-item"><?php print_r($endData) ?><br><?php print_r($endTime) ?><br><?php print_r($endStation) ?></div>
                    <div class="_box-item">Купе от <?php print_r($cost) ?><br>Плацкарт от <?php print_r($cost) ?></div>
                    <button action="buy.php" class="_box-item" type="submit"><p class="anim buy">Take!</p></button>
                </div>
                <?php else: ?>
                <div class="box-item" style="color: black; height: 50px;">
                    Билетов нет
                </div>
                <?php endif; ?>
            </section>

        </main>

    <footer class="main-footer">
            <ul class="footer-nav">
                <li class="footer-nav-item">
                    <a class="link-item" href="work_with.php">Work with</a>
                </li>
                <?php if(isset($_SESSION['user'])) :?>
                <li class="footer-nav-item">
                    <a class="link-item" href="secret.php">Service</a>
                </li>
                <?php else :?>
                <li class="footer-nav-item">
                    <a class="link-item" href="#">Service</a>
                </li>
                <?php endif;?>
                <li class="footer-nav-item">
                    <a class="link-item" href="#">Sitemap</a>
                </li>
                <li class="footer-nav-item">
                    <a class="link-item" href="#">Contacts</a>
                </li>
            </ul>
            <ul class="social">
                <li class="social-item">
                    <a href="https://www.vk.com">
                        <img src="https://lingvo-gap.com/static-files/landing/socials/vk.svg" width="20" height="20">
                    </a>
                </li>
                <li class="social-item">
                    <a src="https://www.instragram.com">
                        <img src="https://lingvo-gap.com/static-files/landing/socials/instagram.svg" width="20" height="20">
                    </a>
                </li>
                <li class="social-item">
                    <a href="https://www.youtube.com/">
                        <img src="https://lingvo-gap.com/static-files/landing/socials/youtube.svg" width="20" height="20">
                    </a>
                </li>
                <li class="social-item">
                    <a href="https://www.youtube.com/">
                        <img src="https://lingvo-gap.com/static-files/landing/socials/youtube.svg" width="20" height="20">
                    </a>
                </li>
            </ul>
            <p class="copyright">
                (c) 2020 <a href="https://github.com/AhEhIOhYou">AhEhIOhYou</a> & <a href="https://vk.com/krivaart">kriva</a>
            </p>
        </footer>
    </body>
</html>

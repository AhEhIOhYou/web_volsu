<?php 
if (isset($_COOKIE['train-id'])) {
    setcookie('train-id', $trainId['id'], time() - 3600, "/");
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="styles/main_style.css" rel="stylesheet">
        <title>AutoTrain | Best tickets store</title>
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

                    <?php if (!isset($_COOKIE['user'])) : ?>

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
        <main>

        <section class="main-content">
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

        </section>
        <section class="ad-content">
            <div class="ad-box">
                Здесь могла быть ваша реклама
            </div>
        </section>
        </main>
        <footer class="main-footer">
            <ul class="footer-nav">
                <li class="footer-nav-item">
                    <a class="link-item" href="work_with.php">Work with</a>
                </li>
                <li class="footer-nav-item">
                    <a class="link-item" href="#">Service</a>
                </li>
                <li class="footer-nav-item">
                    <a class="link-item" href="#">Sitemap</a>
                </li>
                <li class="footer-nav-item">
                    <a class="link-item" href="#">Contacts</a>
                </li>
            </ul>
            <ul class="social">
                <li class="social-item">
                    <a href="https://vk.com">
                        <img src="https://lingvo-gap.com/static-files/landing/socials/vk.svg" width="20" height="20">
                    </a>
                </li>
                <li class="social-item">
                    <a href="https://instagram.com">
                        <img src="https://lingvo-gap.com/static-files/landing/socials/instagram.svg" width="20" height="20">
                    </a>
                </li>
                <li class="social-item">
                    <a href="https://youtube.com">
                        <img src="https://lingvo-gap.com/static-files/landing/socials/youtube.svg" width="20" height="20">
                    </a>
                </li>
                <li class="social-item">
                    <a href="https://youtube.com">
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

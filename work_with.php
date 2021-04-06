<!DOCTYPE html>
<html lang="en">
  <head>
    <head>
      <title>AutoTrain | Work with</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="styles/work_with.css">
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

                    <?php   session_start();
                            if (!isset($_SESSION['user'])) : ?>

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

                    <?php endif; ?>
                </div>
                <p class="after-title-text">Fast, that you think</p>
        </header>
      <main>
        <section class="main-content">
          <h1 class="title-list">Мы работаем с ними:</h1>
          <div class="company-list-box">
            <img src="img/1.png">
            <img src="img/2.png">
            <img src="img/3.png">
            <img src="img/4.png">
            <img src="img/5.png">
            <img src="img/6.png">
          </div>
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

<?php 
    session_start();
    if (isset($_SESSION['user'])) :?>
<!doctype html>
<html lang="en">
  <head>
    <head>
      <title>AutoTrain | Relax page</title>
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

                    <div class="user-item">
                        <a class="link" href="verification/lk.index.php">
                            Личный кабнет
                        </a>
                    </div>

                </div>
                <p class="after-title-text">Fast, that you think</p>
        </header>
      <main>
        <section class="eva-content">
          <h1 class="title-list">Расслабься и посмотри ребилды Евы</h1>
          <div class="eva-list">
            
            <div class="eva-item">
                <p class="eva-title">Evangelion 1.0: You Can (Not) Alone.</p>
                <iframe width="940" height="584" src="https://video.sibnet.ru/shell.php?videoid=2892902" frameborder="0" scrolling="no" allowfullscreen></iframe>            
            </div>
            <div class="eva-item">
                <p class="eva-title">Evangelion 2.0: You Can (Not) Advance.</p>
                <iframe width="940" height="584" src="https://video.sibnet.ru/shell.php?videoid=2892899" frameborder="0" scrolling="no" allowfullscreen></iframe>
            </div>
            <div class="eva-item">
                <p class="eva-title">Evangelion 3.0: You Can (Not) Redo.</p>
                <iframe width="940" height="584" src="https://video.sibnet.ru/shell.php?videoid=2761216" frameborder="0" scrolling="no" allowfullscreen></iframe>
            </div>
            <div class="eva-item">
                <p class="eva-title">Evangelion 3.0 + 1.0: Thrice Upon a Time...</p>
                <iframe width="940" height="584" src="https://www.youtube.com/embed/-CEjqATcPAg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                
            </div>
        
            
          </div>
        </section>
      </main>
      <footer class="main-footer">
        <ul class="footer-nav">
            <li class="footer-nav-item">
                <a class="link-item" href="work_with.html">Work with</a>
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
<?php   else:  header('Location: /');
        endif; 
?>
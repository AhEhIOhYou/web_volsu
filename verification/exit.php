<?php
    setcookie('user', $user['id'], time() - 3600, "/");
    setcookie('train-id', $trainId['id'], time() - 3600, "/");
    header('Location: /index.php');
?>
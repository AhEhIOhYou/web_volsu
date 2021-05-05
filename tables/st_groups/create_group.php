<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Группы" => "http://vladimirov.ivdev.ru/tables/st_groups/st_groups.php",
    "Создание группы" => ""
);

//база данных
require_once "../../include/db_connection.php";
$database = new Database(require '../../include/config.php');
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/group.php";
$group = new Group($db);

?>

<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
        <label >Название группы</label>
        <input type="text" class="form-control" autocomplete="off" name="title-group" pattern="[А-Яа-яA-Za-z0-9\s\w-_]+" placeholder="Впиши название">
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>
<br>

<?php
// если форма была отправлена
if ($_POST) {
    $tg = strip_tags($_POST['title-group']);
    $group->g_name = $tg;

    if ($group->create()) {
        header('Location: http://vladimirov.ivdev.ru/tables/st_groups/st_groups.php');
    }
    else {
        echo "ERROR!";
    }
}
?>

<?php
//footer
require_once "../../include/footer.php";
?>


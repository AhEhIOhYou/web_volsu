<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
        "Группы" => "http://vladimirov.ivdev.ru/tables/st_groups/st_groups.php",
        "Редактирование группы" => ""
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

if ($_POST['new_name']) {

    $group->id = isset($_GET['id']) ? $_GET['id'] : die('Критическая ошибка: ID обновляемого объкта отсутствует - во время пост смены. ㅇㅅㅇ');
    $nn = strip_tags($_POST['new_name']);
    $group->g_name = $nn;

    if ($group->update()) {
        header('Location: http://vladimirov.ivdev.ru/tables/st_groups/st_groups.php');
    }
    else {
        echo "ERROR!";
    }
}
else if (isset($_GET['update_id']))
{
    $group->id = $_GET['update_id'];
    $group->readOne();
} else {
    die('Критическая ошибка: ID обновляемого объкта отсутствует. ㅇㅅㅇ');
}

?>

<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$group->id}")?>" method="POST">
    <div class="form-group">
        <label >Новое название группы</label>
        <input type="text" class="form-control" autocomplete="off" name="new_name" pattern="[А-Яа-яA-Za-z0-9\s-_]+" value='<?php echo $group->g_name; ?>'>
    </div>
    <button type="submit" class="btn btn-primary">Изменить</button>
</form>
<br>

<?php
//footer
require_once "../../include/footer.php";
?>
<?php
//заголовок для этой страницы
$title = "Редактирование группы";

//база данных
require_once "../../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/Group.php";
$group = new Group($db);

if ($_POST['new_name']) {

    $group->id = isset($_GET['id']) ? $_GET['id'] : die('Критическая ошибка: ID обновляемого объкта отсутствует - во время пост смены. ㅇㅅㅇ');
    $group->g_name = $_POST['new_name'];

    if ($group->update()) {
        header('Location: http://vladimirov.ivdev.ru/tables/groups.php?update_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/groups.php?');
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
        <input type="text" class="form-control" name="new_name" value='<?php echo $group->g_name; ?>'>
    </div>
    <button type="submit" class="btn btn-primary">Изменить</button>
</form>
<br>

<?php
//footer
require_once "../../include/footer.php";
?>
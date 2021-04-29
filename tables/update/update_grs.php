<?php
//заголовок для этой страницы
$title = "Редактирование предметов групп";

//база данных
require_once "../../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/GroupsAndSubjects.php";
$grs = new GroupsAndSubjects($db);

if ($_POST['new_group_id'] && $_POST['new_subject_id']) {

    $grs->id = isset($_GET['id']) ? $_GET['id'] : die('Критическая ошибка: ID обновляемого объкта отсутствует - во время пост смены. ㅇㅅㅇ');
    $grs->group_id = $_POST['new_group_id'];
    $grs->subject_id = $_POST['new_subject_id'];

    if ($grs->update()) {
        header('Location: http://vladimirov.ivdev.ru/tables/grs.php?update_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/grs.php?');
    }
}
else if (isset($_POST['update_id']))
{
    $grs->id = $_POST['update_id'];
    $grs->readOne();
} else {
    die('Критическая ошибка: ID обновляемого объкта отсутствует. ㅇㅅㅇ');
}

?>

    <br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$grs->id}")?>" method="POST">
        <div class="form-group">
            <label >Новое ID группы</label>
            <input type="text" class="form-control" name="new_group_id" value='<?php echo $grs->group_id; ?>'>

            <label >Новое ID предмета</label>
            <input type="text" class="form-control" name="new_subject_id" value='<?php echo $grs->subject_id; ?>'>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
    <br>

<?php
//footer
require_once "../../include/footer.php";
?>
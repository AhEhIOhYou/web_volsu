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
require_once "../../src/Subject.php";
require_once "../../src/Group.php";
$grs = new GroupsAndSubjects($db);
$group = new Group($db);
$group_list = $group->readAll();
$subject = new Subject($db);
$subject_list = $subject->readAll();

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
else if (isset($_GET['update_id']))
{
    $grs->id = $_GET['update_id'];
    $grs->readOne();
} else {
    die('Критическая ошибка: ID обновляемого объкта отсутствует. ㅇㅅㅇ');
}

?>

    <br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$grs->id}")?>" method="POST">
        <div class="form-group">
            <label >Новое ID группы</label>
            <select class="form-control" name="new_group_id">
                <? foreach ($group_list as $group): ?>
                    <option value="<? echo $group['id'] ?>"><? echo $group['g_name'] . " - " . $group['id']; ?></option>
                <? endforeach;?>
            </select>

            <label >Новое ID предмета</label>
            <select class="form-control" name="new_subject_id">
                <? foreach ($subject_list as $sbj): ?>
                    <option value="<? echo $sbj['id'] ?>"><? echo $sbj['title'] . " - " . $sbj['id']; ?></option>
                <? endforeach;?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
    <br>

<?php
//footer
require_once "../../include/footer.php";
?>
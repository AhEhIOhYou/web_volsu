<?php
//заголовок для этой страницы
$title = "Создание предмета у группы";

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

?>

<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
        <label >ID группы</label>
        <select class="form-control" name="group_id">
            <? foreach ($group_list as $group): ?>
                <option value="<? echo $group['id'] ?>"><? echo $group['g_name'] . " - " . $group['id']; ?></option>
            <? endforeach;?>
        </select>

        <label >ID предмета</label>
        <select class="form-control" name="subject_id">
            <? foreach ($subject_list as $sbj): ?>
                <option value="<? echo $sbj['id'] ?>"><? echo $sbj['title'] . " - " . $sbj['id']; ?></option>
            <? endforeach;?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>
<br>

<?php
// если форма была отправлена
if ($_POST) {

    $grs->group_id = $_POST['group_id'];
    $grs->subject_id = $_POST['subject_id'];



    if ($grs->create()) {
        header('Location: http://vladimirov.ivdev.ru/tables/grs.php?create_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/grs.php?');
    }
}
?>

<?php
//footer
require_once "../../include/footer.php";
?>


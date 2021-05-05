<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Связь: группы-предметы" => "http://vladimirov.ivdev.ru/tables/group_and_subject/group_and_subject.php",
    "Создания предмета у групп"  => ""
);

//база данных
require_once "../../include/db_connection.php";
$database = new Database(require '../../include/config.php');
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/groups_and_subjects_c.php";
require_once "../../src/subject_c.php";
require_once "../../src/group.php";
$grs = new Groups_and_Subjects($db);
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
        header('Location: http://vladimirov.ivdev.ru/tables/group_and_subject/group_and_subject.php');
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


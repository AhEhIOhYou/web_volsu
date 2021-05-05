<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Оценки" => "http://vladimirov.ivdev.ru/tables/rating/rating.php",
    "Редактирование оценки" => ""
);

//база данных
require_once "../../include/db_connection.php";
$database = new Database(require '../../include/config.php');
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/rating_c.php";
require_once "../../src/groups_and_subjects_c.php";
require_once "../../src/student_c.php";
$mark = new Rating($db);
$student = new Student($db);
$grs = new Groups_and_Subjects($db);
$grs_list = $grs->readAllTitles();
$students_list = $student->readAll();

if ($_POST['new_student_id'] && $_POST['new_grs_id'] && $_POST['new_val']) {

    $mark->id = isset($_GET['id']) ? $_GET['id'] : die('Критическая ошибка: ID обновляемого объкта отсутствует - во время пост смены. ㅇㅅㅇ');
    $mark->student_id = $_POST['new_student_id'];
    $mark->gr_subject_id = $_POST['new_grs_id'];

    $nv = strip_tags($_POST['new_val']);
    $mark->val = $nv;

    if ($mark->update()) {
        header('Location: http://vladimirov.ivdev.ru/tables/rating/rating.php');
    }
    else {
        echo "ERROR!";
    }
}
else if (isset($_GET['update_id']))
{
    $mark->id = $_GET['update_id'];
    $mark->readOne();
} else {
    die('Критическая ошибка: ID обновляемого объкта отсутствует либо поле оценки пустое. ㅇㅅㅇ');
}

?>

    <br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$mark->id}")?>" method="POST">
        <div class="form-group">
            <label >Новое ID студента</label>
            <select class="form-control" name="new_student_id">
                <? foreach ($students_list as $student): ?>
                    <option value="<? echo $student['id'] ?>"><? echo $student['name'] . " - " . $student['id']; ?></option>
                <? endforeach;?>
            </select>

            <label >Новое ID предмета у группы</label>
            <select class="form-control" name="new_grs_id">
                <? foreach ($grs_list as $grs): ?>
                    <option value="<? echo $grs['id'] ?>"><? echo $grs['title'] . " - " . $grs['id']; ?></option>
                <? endforeach;?>
            </select>

            <label >Новая оценка</label>
            <input type="text" class="form-control" autocomplete="off" pattern="[0-9]{1,3}" name="new_val" value='<?php echo $mark->val; ?>'>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
    <br>

<?php
//footer
require_once "../../include/footer.php";
?>
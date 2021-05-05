<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Оценки" => "http://vladimirov.ivdev.ru/tables/rating/rating.php",
    "Создание оценки" => ""
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

?>

<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
        <label >ID студента</label>
        <select class="form-control" name="student_id">
            <? foreach ($students_list as $student): ?>
                <option value="<? echo $student['id'] ?>"><? echo $student['name'] . " - " . $student['id']; ?></option>
            <? endforeach;?>
        </select>

        <label >ID предмета у группы</label>
        <select class="form-control" name="grs_id">
            <? foreach ($grs_list as $grs): ?>
                <option value="<? echo $grs['id'] ?>"><? echo $grs['title'] . " - " . $grs['id']; ?></option>
            <? endforeach;?>
        </select>

        <label >Оценка</label>
        <input type="text" class="form-control" autocomplete="off" pattern="[0-9]{,3}" name="val" placeholder="">
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>
<br>

<?php
// если форма была отправлена
if ($_POST) {

    $mark->gr_subject_id = $_POST['grs_id'];
    $mark->student_id = $_POST['student_id'];
    $v = strip_tags($_POST['val']);
    $mark->val = $v;


    if ($mark->create()) {
        header('Location: http://vladimirov.ivdev.ru/tables/rating/rating.php');
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


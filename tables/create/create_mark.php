<?php
//заголовок для этой страницы
$title = "Создание оценки";

//база данных
require_once "../../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/Rating.php";
require_once "../../src/GroupsAndSubjects.php";
require_once "../../src/Student.php";
$mark = new Rating($db);
$student = new Student($db);
$grs = new GroupsAndSubjects($db);
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
        <input type="text" class="form-control" name="val" placeholder="">
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>
<br>

<?php
// если форма была отправлена
if ($_POST) {

    $mark->gr_subject_id = $_POST['grs_id'];
    $mark->student_id = $_POST['student_id'];
    $mark->val = $_POST['val'];


    if ($mark->create()) {
        header('Location: http://vladimirov.ivdev.ru/tables/marks.php?create_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/marks.php?');
    }
}
?>

<?php
//footer
require_once "../../include/footer.php";
?>


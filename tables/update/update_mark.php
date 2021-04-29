<?php
//заголовок для этой страницы
$title = "Редактирование оценки";

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

if ($_POST['new_student_id'] && $_POST['new_grs_id'] && $_POST['new_val']) {

    $mark->id = isset($_GET['id']) ? $_GET['id'] : die('Критическая ошибка: ID обновляемого объкта отсутствует - во время пост смены. ㅇㅅㅇ');
    $mark->student_id = $_POST['new_student_id'];
    $mark->gr_subject_id = $_POST['new_grs_id'];
    $mark->val = $_POST['new_val'];

    if ($mark->update()) {
        header('Location: http://vladimirov.ivdev.ru/tables/marks.php?update_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/marks.php?');
    }
}
else if (isset($_GET['update_id']))
{
    $mark->id = $_GET['update_id'];
    $mark->readOne();
} else {
    die('Критическая ошибка: ID обновляемого объкта отсутствует. ㅇㅅㅇ');
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
            <input type="text" class="form-control" name="new_val" value='<?php echo $mark->val; ?>'>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
    <br>

<?php
//footer
require_once "../../include/footer.php";
?>
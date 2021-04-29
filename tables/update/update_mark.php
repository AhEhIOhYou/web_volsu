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
$mark = new Rating($db);

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
else if (isset($_POST['update_id']))
{
    $mark->id = $_POST['update_id'];
    $mark->readOne();
} else {
    die('Критическая ошибка: ID обновляемого объкта отсутствует. ㅇㅅㅇ');
}

?>

    <br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$mark->id}")?>" method="POST">
        <div class="form-group">
            <label >Новое ID студента</label>
            <input type="text" class="form-control" name="new_student_id" value='<?php echo $mark->student_id; ?>'>

            <label >Новое ID предмета у группы</label>
            <input type="text" class="form-control" name="new_grs_id" value='<?php echo $mark->gr_subject_id; ?>'>

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
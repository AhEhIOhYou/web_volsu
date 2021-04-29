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
require_once "../../src/Student.php";
$student = new Student($db);

if ($_POST['new_name'] && $_POST['new_group_id']) {

    $student->id = isset($_GET['id']) ? $_GET['id'] : die('Критическая ошибка: ID обновляемого объкта отсутствует - во время пост смены. ㅇㅅㅇ');
    $student->name = $_POST['new_name'];
    $student->group_id = $_POST['new_group_id'];

    if ($student->update()) {
        header('Location: http://vladimirov.ivdev.ru/tables/students.php?update_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/students.php?');
    }
}
else if (isset($_POST['update_id']))
{
    $student->id = $_POST['update_id'];
    $student->readOne();
} else {
    die('Критическая ошибка: ID обновляемого объкта отсутствует. ㅇㅅㅇ');
}

?>

    <br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$student->id}")?>" method="POST">
        <div class="form-group">
            <label >Новое имя студента</label>
            <input type="text" class="form-control" name="new_name" value='<?php echo $student->name; ?>'>

            <label >Новый ID группы студента</label>
            <input type="text" class="form-control" name="new_group_id" value='<?php echo $student->group_id; ?>'>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
    <br>

<?php
//footer
require_once "../../include/footer.php";
?>
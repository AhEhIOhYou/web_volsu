<?php
//заголовок для этой страницы
$title = "Редактирование предмета";

//база данных
require_once "../../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/Subject.php";
$subject = new Subject($db);

if ($_POST['new_title']) {

    $subject->id = isset($_GET['id']) ? $_GET['id'] : die('Критическая ошибка: ID обновляемого объкта отсутствует - во время пост смены. ㅇㅅㅇ');
    $subject->title = $_POST['new_title'];

    if ($subject->update()) {
        header('Location: http://vladimirov.ivdev.ru/tables/subjects.php?update_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/subjects.php?');
    }
}
else if (isset($_GET['update_id']))
{
    $subject->id = $_GET['update_id'];
    $subject->readOne();
} else {
    die('Критическая ошибка: ID обновляемого объкта отсутствует. ㅇㅅㅇ');
}

?>

    <br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$subject->id}")?>" method="POST">
        <div class="form-group">
            <label >Новое название предмета</label>
            <input type="text" class="form-control" name="new_title" value='<?php echo $subject->title; ?>'>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
    <br>

<?php
//footer
require_once "../../include/footer.php";
?>
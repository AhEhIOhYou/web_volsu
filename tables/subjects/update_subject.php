<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Предметы" => "http://vladimirov.ivdev.ru/tables/subjects/subjects.php",
    "Редактирование предмета"  => ""
);

//база данных
require_once "../../include/db_connection.php";
$database = new Database(require '../../include/config.php');
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/subject_c.php";
$subject = new Subject($db);

if ($_POST['new_title']) {

    $subject->id = isset($_GET['id']) ? $_GET['id'] : die('Критическая ошибка: ID обновляемого объкта отсутствует - во время пост смены. ㅇㅅㅇ');

    $nt = strip_tags($_POST['new_title']);
    $subject->title = $nt;


    if ($subject->update()) {
        header('Location: http://vladimirov.ivdev.ru/tables/subjects/subjects.php');
    }
    else {
        echo "ERROR!";
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
            <input type="text" class="form-control" autocomplete="off" name="new_title" pattern="[А-Яа-яA-Za-z0-9\s\w-_/]+" value='<?php echo $subject->title; ?>'>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
    <br>

<?php
//footer
require_once "../../include/footer.php";
?>
<?php
//заголовок для этой страницы
$title = "Создание группы";

//база данных
require_once "../../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/Subject.php";
$subject = new Subject($db);

?>

<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
        <label >Название предмета</label>
        <input type="text" class="form-control" name="title-subject" placeholder="Впиши название">
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>
<br>

<?php
// если форма была отправлена
if ($_POST) {

    $subject->title = $_POST['title-subject'];



    if ($subject->create()) {
        header('Location: http://vladimirov.ivdev.ru/tables/subjects.php?create_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/subjectss.php?');
    }
}
?>

<?php
//footer
require_once "../../include/footer.php";
?>


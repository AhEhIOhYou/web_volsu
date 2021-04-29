<?php
//заголовок для этой страницы
$title = "Создание предмета у группы";

//база данных
require_once "../../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/GroupsAndSubjects.php";
$grs = new GroupsAndSubjects($db);

?>

<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
        <label >ID группы</label>
        <input type="text" class="form-control" name="group_id" placeholder="Впиши ID группы">

        <label >ID предмета</label>
        <input type="text" class="form-control" name="subject_id" placeholder="Впиши ID предмета">
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
        header('Location: http://vladimirov.ivdev.ru/tables/grs.php?create_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/grs.php?');
    }
}
?>

<?php
//footer
require_once "../../include/footer.php";
?>


<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Предметы" => "http://vladimirov.ivdev.ru/tables/subjects/subjects.php",
    "Создание предмета"  => ""
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

?>

<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
        <label >Название предмета</label>
        <input type="text" class="form-control" autocomplete="off" pattern="[А-Яа-яA-Za-z0-9\s\w-_\]+" name="title-subject" placeholder="Впиши название">
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>
<br>

<?php
// если форма была отправлена
if ($_POST) {

    $nt = strip_tags($_POST['new_title']);
    $subject->title = $nt;


    if ($subject->create()) {
        header('Location: http://vladimirov.ivdev.ru/tables/subjectss/subjects.php');
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


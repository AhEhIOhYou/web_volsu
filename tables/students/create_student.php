<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Студенты" => "http://vladimirov.ivdev.ru/tables/students/students.php",
    "Создание студента" => ""
);

//база данных
require_once "../../include/db_connection.php";
$database = new Database(require '../../include/config.php');
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/student_c.php";
require_once "../../src/group.php";
$student = new Student($db);
$group = new Group($db);
$group_list = $group->readAll();

?>

<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
        <label >Имя студента</label>
        <input type="text" class="form-control" pattern="[А-Яа-яA-Za-z0-9\s\w]+" name="name-student" autocomplete="off" placeholder="Впиши имя">

        <label >Группа</label>
        <select class="form-control" name="id-group">
            <? foreach ($group_list as $group): ?>
                <option value="<? echo $group['id'] ?>"><? echo $group['g_name']; ?></option>
            <? endforeach;?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>
<br>


<?php
// если форма была отправлена
if ($_POST) {

    $ns = strip_tags($_POST['name-student']);
    $student->name = $ns;
    $student->group_id = $_POST['id-group'];

    if ($student->create()) {
        header('Location: http://vladimirov.ivdev.ru/tables/students/students.php');
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


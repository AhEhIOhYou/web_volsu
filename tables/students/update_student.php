<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Студенты" => "http://vladimirov.ivdev.ru/tables/students/students.php",
    "Редактирование студента" => ""
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

if ($_POST['new_name'] && $_POST['new_group_id']) {

    $student->id = isset($_GET['id']) ? $_GET['id'] : die('Критическая ошибка: ID обновляемого объкта отсутствует - во время пост смены. ㅇㅅㅇ');

    $nn = strip_tags($_POST['new_name']);
    $student->name = $nn;
    $student->group_id = $_POST['new_group_id'];

    if ($student->update()) {
        header('Location: http://vladimirov.ivdev.ru/tables/students/students.php');
    }
    else {
        echo "ERROR!";
    }
}
else if (isset($_GET['update_id']))
{
    $student->id = $_GET['update_id'];
    $student->readOne();
} else {
    die('Критическая ошибка: ID обновляемого объкта отсутствует. ㅇㅅㅇ');
}

?>

    <br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$student->id}")?>" method="POST">
        <div class="form-group">
            <label >Новое имя студента</label>
            <input type="text" class="form-control" pattern="[А-Яа-яA-Za-z0-9\s\w]+" autocomplete="off" name="new_name" value='<?php echo $student->name; ?>'>

            <label >Новая группа студента и её ID</label>
            <select class="form-control" name="new_group_id">
                <? foreach ($group_list as $group): ?>
                    <option value="<? echo $group['id'] ?>"><? echo $group['g_name'] . " - " . $group['id']; ?></option>
                <? endforeach;?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
    <br>

<?php
//footer
require_once "../../include/footer.php";
?>
<?php
//заголовок для этой страницы
$title = "Создание студента";

//база данных
require_once "../../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/Student.php";
require_once "../../src/Group.php";
$student = new Student($db);
$group = new Group($db);
$group_list = $group->readAll();

?>

<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
        <label >Имя студента</label>
        <input type="text" class="form-control" name="name-student" placeholder="Впиши имя">

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
    $student->name = $_POST['name-student'];
    $student->group_id = $_POST['id-group'];

    if ($student->create()) {
        header('Location: http://vladimirov.ivdev.ru/tables/students.php?create_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/students.php?');
    }
}
?>

<?php
//footer
require_once "../../include/footer.php";
?>


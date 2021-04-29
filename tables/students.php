<?php
//заголовок для этой страницы
$title = "Студенты";

//база данных
require_once "../include/db_connection.php";
require_once "../src/Student.php";
require_once "../src/Subject.php";
require_once "../src/Rating.php";

$database = new Database();
$db = $database->getConnection();

// создадим экземпляры классов
$student = new Student($db);
$students_list = $student->readAll();

//header
require_once "../include/header.php";
?>
    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Имя</td>
            <td>ID группы</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        <? foreach ($students_list as $item):?>
            <tr>
                <td><? echo $item['id'] ?></td>
                <td><? echo $item['name'] ?></td>
                <td><? echo $item['group_id'] ?></td>
                <td>
                    <form method="get" action="/tables/update/update_student.php/" style="display: inline-block">
                        <button type="submit" name="update_id" value="<?echo $item['id'] ?>" class="btn btn-primary">Редактировать</button>
                    </form>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: inline-block">
                        <button type="submit" name="delete_id" value="<?echo $item['id'] ?>" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>

    <div class='right-button-margin'>
        <a href="/tables/create/create_student.php/" class='btn btn-success pull-center'>Создать студента</a>
    </div>

<br>

<?php
if (isset($_GET['create_success'])) {
    if ($_GET['create_success'] == 0) {
        echo "<div class='alert alert-success'>Студент создан</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно создать студента</div>";
    }
}
if (isset($_GET['delete_success'])) {
    if ($_GET['delete_success'] == 0) {
        echo "<div class='alert alert-success'>Студент удален</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно удалить студента</div>";
    }
}
if (isset($_GET['update_success'])) {
    if ($_GET['update_success'] == 0) {
        echo "<div class='alert alert-success'>Студент обновлен</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно обновить данные студента</div>";
    }
}
?>

<?php
if (isset($_POST['delete_id'])) {

    $student->id = $_POST['delete_id'];

    if ($student->delete()) {
        header('Location: http://vladimirov.ivdev.ru/tables/students.php?delete_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/students.php?');
    }
}
?>

<?php
//footer
require_once "../include/footer.php";
?>
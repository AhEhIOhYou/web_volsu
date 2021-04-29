<?php
//заголовок для этой страницы
$title = "Оценки";

//база данных
require_once "../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../include/header.php";

//классы
require_once "../src/Rating.php";
$mark = new Rating($db);
$marks_list = $mark->readAll();

?>
    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>ID ученика</td>
            <td>ID предмета группы</td>
            <td>Оценка</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        <? foreach ($marks_list as $item):?>
            <tr>
                <td><? echo $item['id'] ?></td>
                <td><? echo $item['student_id'] ?></td>
                <td><? echo $item['gr_subject_id'] ?></td>
                <td><? echo $item['val'] ?></td>
                <td>
                    <form method="get" action="/tables/update/update_mark.php/" style="display: inline-block">
                        <button type="submit" name="update_id" value="<?echo $item['id'] ?>" class="btn btn-primary">Редактировать</button>
                    </form>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: inline-block" >
                        <button type="submit" name="delete_id" value="<?echo $item['id'] ?>" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>

    <div class='right-button-margin'>
        <a href="/tables/create/create_mark.php/" class='btn btn-success pull-center'>Создать оценку</a>
    </div>
    <br>

<?php
if (isset($_GET['create_success'])) {
    if ($_GET['create_success'] == 0) {
        echo "<div class='alert alert-success'>Оценка создана</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно создать оценку</div>";
    }
}
if (isset($_GET['delete_success'])) {
    if ($_GET['delete_success'] == 0) {
        echo "<div class='alert alert-success'>Оценка удалена</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно удалить оценку</div>";
    }
}
if (isset($_GET['update_success'])) {
    if ($_GET['update_success'] == 0) {
        echo "<div class='alert alert-success'>Оценка обновлена</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно обновить оценку</div>";
    }
}
?>

<?php
if (isset($_POST['delete_id'])) {

    $mark->id = $_POST['delete_id'];

    if ($mark->delete()) {
        header('Location: http://vladimirov.ivdev.ru/tables/marks.php?delete_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/marks.php?');
    }
}
?>



<?php
//footer
require_once "../include/footer.php";
?>
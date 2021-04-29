<?php
//заголовок для этой страницы
$title = "Предметы";
//хлебные крошки
$breadcrumbs = [];
//база данных
require_once "../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../include/header.php";

//классы
require_once "../src/Subject.php";
$mark = new Subject($db);
$subj_list = $mark->readAll();

?>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <td>ID</td>
            <td>Предмет</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        <? foreach ($subj_list as $item):?>
            <tr>
                <td><? echo $item['id'] ?></td>
                <td><? echo $item['title'] ?></td>
                <td>
<!--                    гет запрос-->
                    <form method="get" action="/tables/update/update_subject.php/" style="display: inline-block">
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
        <a href="/tables/create/create_subject.php/" class='btn btn-success pull-center'>Создать группу</a>
    </div>
    <br>

<?php
if (isset($_GET['create_success'])) {
    if ($_GET['create_success'] == 0) {
        echo "<div class='alert alert-success'>Предмет создан</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно создать предмет</div>";
    }
}
if (isset($_GET['delete_success'])) {
    if ($_GET['delete_success'] == 0) {
        echo "<div class='alert alert-success'>Предмет удален</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно удалить предмет</div>";
    }
}
if (isset($_GET['update_success'])) {
    if ($_GET['update_success'] == 0) {
        echo "<div class='alert alert-success'>Предмет обновлен</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно обновить данные предмета</div>";
    }
}
?>

<?php
if (isset($_POST['delete_id'])) {

    $mark->id = $_POST['delete_id'];

    if ($mark->delete()) {
        header('Location: http://vladimirov.ivdev.ru/tables/subjects.php?delete_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/subjects.php?');
    }
}
?>




<?php
//footer
require_once "../include/footer.php";
?>
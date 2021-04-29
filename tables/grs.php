<?php
//заголовок для этой страницы
$title = "Связь: группы-предметы";

//база данных
require_once "../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../include/header.php";

//классы
require_once "../src/GroupsAndSubjects.php";
$grs = new GroupsAndSubjects($db);
$grs_list = $grs->readAll();

?>
    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>ID группы</td>
            <td>ID предмета</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        <? foreach ($grs_list as $item):?>
            <tr>
                <td><? echo $item['id'] ?></td>
                <td><? echo $item['group_id'] ?></td>
                <td><? echo $item['subject_id'] ?></td>
                <td>
                    <form method="get" action="/tables/update/update_grs.php/" style="display: inline-block">
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
        <a href="/tables/create/create_grs.php/" class='btn btn-success pull-center'>Создать новый</a>
    </div>
    <br>

<?php
if (isset($_GET['create_success'])) {
    if ($_GET['create_success'] == 0) {
        echo "<div class='alert alert-success'>Предмет у группы создан</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно создать предмет у группы</div>";
    }
}
if (isset($_GET['delete_success'])) {
    if ($_GET['delete_success'] == 0) {
        echo "<div class='alert alert-success'>Предмет у группы удален</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно удалить предмет у группы</div>";
    }
}
if (isset($_GET['update_success'])) {
    if ($_GET['update_success'] == 0) {
        echo "<div class='alert alert-success'>Предмет у группы обновлен</div>";
    } else {
        echo "<div class='alert alert-danger'>Невозможно обновить данные</div>";
    }
}
?>

<?php
if (isset($_POST['delete_id'])) {

    $grs->id = $_POST['delete_id'];

    if ($grs->delete()) {
        header('Location: http://vladimirov.ivdev.ru/tables/grs.php?delete_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/grs.php?');
    }
}
?>


<?php
//footer
require_once "../include/footer.php";
?>
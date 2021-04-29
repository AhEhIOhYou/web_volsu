<?php
//заголовок для этой страницы
$title = "Группы";

//база данных
require_once "../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../include/header.php";

//классы
require_once "../src/Group.php";
$group = new Group($db);
$groups_list = $group->read();

?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <td>ID</td>
            <td>Группа</td>
            <td>Действия</td>
        </tr>
    </thead>
    <tbody>
        <? foreach ($groups_list as $item):?>
        <tr>
            <td><? echo $item['id'] ?></td>
            <td><? echo $item['g_name'] ?></td>
            <td>
                <form method="post" action="/tables/update/update_group.php/" style="display: inline-block">
                    <button type="submit" name="update_id" value="<?echo $item['id'] ?>" class="btn btn-primary">Редактировать</button>
                </form>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: inline-block" >
                    <button type="submit" name="delete_id" value="<?echo $item['id'] ?>" class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>

    <div class='right-button-margin'>
        <a href="/tables/create/create_group.php/" class='btn btn-success pull-center'>Создать группу</a>
    </div>
<br>

<?php
    if (isset($_GET['create_success'])) {
        if ($_GET['create_success'] == 0) {
            echo "<div class='alert alert-success'>Группа создана</div>";
        } else {
            echo "<div class='alert alert-danger'>Невозможно создать группу</div>";
        }
    }
    if (isset($_GET['delete_success'])) {
        if ($_GET['delete_success'] == 0) {
            echo "<div class='alert alert-success'>Группа удалена</div>";
        } else {
            echo "<div class='alert alert-danger'>Невозможно удалить группу</div>";
        }
    }
    if (isset($_GET['update_success'])) {
        if ($_GET['update_success'] == 0) {
            echo "<div class='alert alert-success'>Группа обновлена</div>";
        } else {
            echo "<div class='alert alert-danger'>Невозможно обновить данные группы</div>";
        }
    }
?>

<?php
if (isset($_POST['delete_id'])) {

    $group->id = $_POST['delete_id'];

    if ($group->delete()) {
        header('Location: http://vladimirov.ivdev.ru/tables/groups.php?delete_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/groups.php?');
    }
}
?>


<?php
//footer
require_once "../include/footer.php";
?>
<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Группы"  => ""
);

//база данных
require_once "../../include/db_connection.php";
$database = new Database(require '../../include/config.php');
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/group.php";
$group = new Group($db);
$groups_list = $group->readAll();

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
                <form method="get" action="/tables/st_groups/update_group.php" style="display: inline-block">
                    <button type="submit" name="update_id" value="<?echo $item['id'] ?>" class="btn btn-primary">Редактировать</button>
                </form>
                <form method="get" action="/tables/delete.php" style="display: inline-block">
                    <input name="table" value="<?echo $group->getTableName() ?>" style="display: none">
                    <button type="submit" name="delete_id" onclick="return  confirm('Удалить?')" value="<?echo $item['id'] ?>" class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>

    <div class='right-button-margin'>
        <a href="/tables/st_groups/create_group.php" class='btn btn-success pull-center'>Создать группу</a>
    </div>
<br>


<?php
//footer
require_once "../../include/footer.php";
?>
<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Связь: группы-предметы"  => ""
);

//база данных
require_once "../../include/db_connection.php";
$database = new Database(require '../../include/config.php');
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/groups_and_subjects_c.php";
$grs = new Groups_and_Subjects($db);
$grs_list = $grs->readData();

?>
    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Группа</td>
            <td>Предмет</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        <? foreach ($grs_list as $item):?>
            <tr>
                <td><? echo $item['id'] ?></td>
                <td><? echo $item['g_name'] ?></td>
                <td><? echo $item['title'] ?></td>
                <td>
                    <form method="get" action="/tables/group_and_subject/update_grs.php" style="display: inline-block">
                        <button type="submit" name="update_id" value="<?echo $item['id'] ?>" class="btn btn-primary">Редактировать</button>
                    </form>
                    <form method="get" action="/tables/delete.php" style="display: inline-block">
                        <input name="table" value="<?echo $grs->getTableName() ?>" style="display: none">
                        <button type="submit" name="delete_id" onclick="return  confirm('Удалить?')" value="<?echo $item['id'] ?>" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
    <div class='right-button-margin'>
        <a href="/tables/group_and_subject/create_grs.php" class='btn btn-success pull-center'>Создать новый</a>
    </div>
    <br>

<?php
//footer
require_once "../../include/footer.php";
?>
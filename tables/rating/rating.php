<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Оценки"  => ""
);

//база данных
require_once "../../include/db_connection.php";
$database = new Database(require '../../include/config.php');
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/rating_c.php";
$mark = new Rating($db);
$marks_list = $mark->readData();

?>
    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Студент</td>
            <td>Предмет группы</td>
            <td>Оценка</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        <? foreach ($marks_list as $item):?>
            <tr>
                <td><? echo $item['id'] ?></td>
                <td><? echo $item['name'] ?></td>
                <td><? echo $item['title'] ?></td>
                <td><? echo $item['val'] ?></td>
                <td>
                    <form method="get" action="/tables/rating/update_mark.php" style="display: inline-block">
                        <button type="submit" name="update_id" value="<?echo $item['id'] ?>" class="btn btn-primary">Редактировать</button>
                    </form>
                    <form method="get" action="/tables/delete.php" style="display: inline-block">
                        <input name="table" value="<?echo $mark->getTableName() ?>" style="display: none">
                        <button type="submit" name="delete_id" onclick="return  confirm('Удалить?')" value="<?echo $item['id'] ?>" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>

    <div class='right-button-margin'>
        <a href="/tables/rating/create_mark.php" class='btn btn-success pull-center'>Создать оценку</a>
    </div>
    <br>

<?php
//footer
require_once "../../include/footer.php";
?>